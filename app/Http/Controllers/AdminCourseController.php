<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseLesson;
use App\Models\CourseProgress;

class AdminCourseController extends Controller
{
    public function index() {
        $courses = Course::latest()->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }
    public function create() {
        return view('admin.courses.create');
    }
    public function store(Request $request) {
        $request->validate(['title'=>'required', 'price'=>'required|numeric']);
        Course::create($request->all());
        return redirect('admin/courses')->with('success', 'Course added successfully.');
    }

    public function edit($id) {
        $course = Course::findOrFail($id);
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, $id) {
        $request->validate(['title'=>'required', 'price'=>'required|numeric']);
        $course = Course::findOrFail($id);
        $course->update($request->all());
        return redirect('admin/courses')->with('success', 'Course updated successfully.');
    }

    public function destroy($id) {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect('admin/courses')->with('success', 'Course deleted successfully.');
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