<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Course;

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
}