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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cropped_image' => 'nullable|string',
            'link_url' => 'nullable|url',
        ]);

        $imagePath = '';
        if ($request->filled('cropped_image')) {
            $croppedData = $request->input('cropped_image');
            if (preg_match('/^data:image\/(\w+);base64,/', $croppedData, $type)) {
                $croppedData = substr($croppedData, strpos($croppedData, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, gif

                if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
                    return back()->withErrors(['image' => 'Invalid image format.']);
                }

                $croppedData = base64_decode($croppedData);
                if ($croppedData === false) {
                    return back()->withErrors(['image' => 'Base64 decode failed.']);
                }

                $imageName = 'banner_' . time() . '_' . Str::random(10) . '.' . $type;
                file_put_contents(public_path('uploads/banners/' . $imageName), $croppedData);
                $imagePath = asset('uploads/banners/' . $imageName);
            }
        } elseif ($request->hasFile('image')) {
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

    public function updateBanner(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link_url' => 'nullable|url',
            'cropped_image' => 'nullable|string', // Base64
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'status' => 'required|in:active,inactive'
        ]);

        $banner = Banner::findOrFail($id);

        $imagePath = $banner->image_url;
        if ($request->filled('cropped_image')) {
            $data = $request->input('cropped_image');
            if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
                $data = substr($data, strpos($data, ',') + 1);
                $type = strtolower($type[1]);

                $croppedData = base64_decode($data);
                $imageName = 'banner_' . time() . '_' . Str::random(10) . '.' . $type;
                file_put_contents(public_path('uploads/banners/' . $imageName), $croppedData);
                $imagePath = asset('uploads/banners/' . $imageName);
            }
        } elseif ($request->hasFile('image')) {
            $imageName = 'banner_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/banners'), $imageName);
            $imagePath = asset('uploads/banners/' . $imageName);
        }

        $banner->update([
            'title' => $request->title,
            'image_url' => $imagePath,
            'link_url' => $request->link_url,
            'status' => $request->status
        ]);

        return back()->with('success', 'Banner updated successfully.');
    }

    public function updateAnnouncement(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:info,warning,success,danger',
            'status' => 'required|in:active,inactive'
        ]);

        $announcement = Announcement::findOrFail($id);
        $announcement->update($request->only(['title', 'content', 'type', 'status']));

        return back()->with('success', 'Announcement updated successfully.');
    }

    public function destroyPage($id)
    {
        Page::findOrFail($id)->delete();
        return back()->with('success', 'Page deleted successfully.');
    }
}
