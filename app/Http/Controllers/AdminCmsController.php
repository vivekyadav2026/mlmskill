<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Announcement;
use App\Models\Page;
use Illuminate\Support\Str;

class AdminCmsController extends Controller
{
    // --- Banners ---
    public function banners()
    {
        $banners = Banner::latest()->get();
        return view('admin.cms.banners', compact('banners'));
    }

    public function storeBanner(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_url' => 'nullable|url',
        ]);

        $imagePath = '';
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/banners'), $imageName);
            $imagePath = asset('uploads/banners/' . $imageName);
        }

        Banner::create([
            'title' => $request->title,
            'image_url' => $imagePath,
            'link_url' => $request->link_url,
            'status' => 'active'
        ]);
        return back()->with('success', 'Banner uploaded successfully.');
    }

    public function destroyBanner($id)
    {
        Banner::findOrFail($id)->delete();
        return back()->with('success', 'Banner deleted successfully.');
    }

    // --- Announcements ---
    public function announcements()
    {
        $announcements = Announcement::latest()->get();
        return view('admin.cms.announcements', compact('announcements'));
    }

    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:info,warning,success,danger',
        ]);

        Announcement::create($request->only(['title', 'content', 'type']) + ['status' => 'active']);
        return back()->with('success', 'Announcement published successfully.');
    }

    public function destroyAnnouncement($id)
    {
        Announcement::findOrFail($id)->delete();
        return back()->with('success', 'Announcement deleted successfully.');
    }

    // --- Pages ---
    public function pages()
    {
        $pages = Page::latest()->get();
        return view('admin.cms.pages', compact('pages'));
    }

    public function storePage(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => 'published'
        ]);
        return back()->with('success', 'Page published successfully.');
    }

    public function destroyPage($id)
    {
        Page::findOrFail($id)->delete();
        return back()->with('success', 'Page deleted successfully.');
    }
}
