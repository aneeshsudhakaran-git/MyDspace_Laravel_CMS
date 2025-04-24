<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Admin\MediaManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class MediaManagerController extends Controller
{
    // Upload Image
    public function upload(Request $request)
    {
        // Manual validation for more control over error formatting
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        // If validation fails, return a JSON response with the error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all(),
                'msg' => 'Image Uploaded Failed! Please try with a valid Image [jpeg,png,jpg,gif]', 
            ], 422);
        }
        
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('uploads', $filename, 'public');

            $media = MediaManager::create(['file_path' => $path]);

            return response()->json(['success' => true, 'msg' => 'Image Uploaded Successfully', 'file_path' => asset('storage/' . $path)]);
        }

        return response()->json([
            'success' => false,
            'msg' => 'Image Uploaded Failed! Please try with a valid Image File!', 
            'errors' => ['No file was uploaded.']
        ], 400);
    }

    // Fetch Uploaded Images
    public function medialist(Request $request)
    {
        $search = $request->input('search');
        $query = MediaManager::query();

        if ($search) {
            $query->where('tag', 'like', "%{$search}%");
        }

        $media = $query->orderBy('file_path', 'asc')->latest()->paginate(12); // pagination

        if ($request->ajax()) {
            return view('admin.media.media_list', compact('media'))->render();
        }

        return view('admin.media.mediamanager', compact('media'));

    }

    // Function to update the tag of a media file
    public function updateTag(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required|exists:media_managers,id',
            'tag' => 'nullable|string|max:255',
        ]);

        $media = MediaManager::findOrFail($request->id);
        $media->tag = $request->tag;
        $media->save();

        return response()->json([
            'success' => true,
            'message' => 'Tag updated successfully!',
            'tag' => $media->tag
        ]);
    }

    // destroy
    public function destroy($id) {
        $media = MediaManager::findOrFail($id);

       // dd('storage/'.$media->file_path);

        // Delete the file from storage (if using storage/app/public or similar)
        if (Storage::disk('public')->exists($media->file_path)) {
            Storage::disk('public')->delete($media->file_path);
        }

        // Delete the database record
        $media->delete();

        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }
}
