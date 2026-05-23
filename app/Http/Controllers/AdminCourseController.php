<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseLesson;
use App\Models\CourseProgress;
use Illuminate\Support\Facades\Storage;

class AdminCourseController extends Controller
{
    public function index() {
        $courses = Course::with(['module', 'lessons'])->latest()->paginate(15);
        $modules = \App\Models\CourseModule::all();
        return view('admin.courses.index', compact('courses', 'modules'));
    }
    public function create() {
        $modules = \App\Models\CourseModule::where('status', 'active')->get();
        return view('admin.courses.create', compact('modules'));
    }
    public function store(Request $request) {
        $request->validate([
            'title'=>'required', 
            'price'=>'required|numeric', 
            'module_id'=>'nullable|exists:course_modules,id',
            'pdf_file'=>'nullable|mimes:pdf|max:10240'
        ]);
        
        $data = $request->all();
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('course_pdfs'), $filename);
            $data['pdf_path'] = 'course_pdfs/' . $filename;
        }

        Course::create($data);
        return redirect('admin/courses')->with('success', 'Course added successfully.');
    }

    public function edit($id) {
        $course = Course::findOrFail($id);
        $modules = \App\Models\CourseModule::where('status', 'active')->get();
        return view('admin.courses.edit', compact('course', 'modules'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title'=>'required', 
            'price'=>'required|numeric', 
            'module_id'=>'nullable|exists:course_modules,id',
            'pdf_file'=>'nullable|mimes:pdf|max:10240'
        ]);
        $course = Course::findOrFail($id);
        
        $data = $request->all();
        if ($request->hasFile('pdf_file')) {
            if ($course->pdf_path && file_exists(public_path($course->pdf_path))) {
                @unlink(public_path($course->pdf_path));
            }
            $file = $request->file('pdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('course_pdfs'), $filename);
            $data['pdf_path'] = 'course_pdfs/' . $filename;
        }

        $course->update($data);
        return redirect('admin/courses')->with('success', 'Course updated successfully.');
    }

    public function destroy($id) {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect('admin/courses')->with('success', 'Course deleted successfully.');
    }

    // Module Management
    public function modules() {
        $modules = \App\Models\CourseModule::with('courses')->withCount('courses')->latest()->paginate(15);
        $allCourses = Course::all();
        return view('admin.courses.modules', compact('modules', 'allCourses'));
    }

    public function storeModule(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);
        \App\Models\CourseModule::create($request->all());
        return redirect()->route('admin.courses.modules')->with('success', 'Course Module created successfully.');
    }

    public function updateModule(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);
        $module = \App\Models\CourseModule::findOrFail($id);
        $module->update($request->all());
        return redirect()->route('admin.courses.modules')->with('success', 'Course Module updated successfully.');
    }

    public function destroyModule($id) {
        $module = \App\Models\CourseModule::findOrFail($id);
        $module->delete();
        return redirect()->route('admin.courses.modules')->with('success', 'Course Module deleted successfully.');
    }

    public function assignCourses(Request $request, $id) {
        $module = \App\Models\CourseModule::findOrFail($id);
        
        // Remove this module from courses that were unchecked
        $courseIds = $request->input('course_ids', []);
        Course::where('module_id', $module->id)
              ->whereNotIn('id', $courseIds)
              ->update(['module_id' => null]);
              
        // Add this module to checked courses
        if (!empty($courseIds)) {
            Course::whereIn('id', $courseIds)->update(['module_id' => $module->id]);
        }
        
        return redirect()->route('admin.courses.modules')->with('success', 'Courses successfully assigned to module!');
    }

    public function content() {
        $courses = Course::with('lessons')->get();
        return view('admin.courses.content', compact('courses'));
    }

    public function storeContent(Request $request) {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'duration' => 'nullable|integer',
        ]);

        CourseLesson::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'video_url' => $request->video_url,
            'duration' => $request->duration,
            'status' => 'active'
        ]);

        return redirect()->route('admin.courses.content')->with('success', 'Course lesson added successfully.');
    }

    public function destroyContent($id) {
        $lesson = CourseLesson::findOrFail($id);
        $lesson->delete();
        return redirect()->route('admin.courses.content')->with('success', 'Course lesson deleted successfully.');
    }

    public function progress() {
        $progressRecords = CourseProgress::with(['user', 'course'])->latest()->paginate(20);
        return view('admin.courses.progress', compact('progressRecords'));
    }
}