<?php

namespace App\Http\Controllers;

use App\Models\Viewer;
use Illuminate\Http\Request;

class ApiViewerController extends Controller
{
    public function count(Request $request)
    {
        $viewerId = $request->input('viewer_id');
        $viewer = Viewer::findOrNew($viewerId);
        $viewer->view_count++;
        $viewer->save();
        return response()->json(['message' => 'Viewer count updated']);
    }
}
