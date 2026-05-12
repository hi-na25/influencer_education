<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    // バナー管理画面の表示
    public function showBannerEdit()
    {
        // 1. 保存されているバナーを全部持ってくる
        $banners = Banner::all();

        // 2. viewにバナー一覧を渡す
        return view('admin.banner_edit', compact('banners'));
    }


    // バナーの保存処理
    public function store(Request $request)
    {
        // データの取得を先に行う
        $bannersData = $request->input('banners', []);
        $bannersFiles = $request->file('banners', []);
        $allKeys = array_unique(array_merge(array_keys($bannersData), array_keys($bannersFiles)));

        // DB操作が始まる前にトランザクションを開始
        $controller = $this;
        return DB::transaction(function () use ($request, $allKeys, $bannersData, $bannersFiles, $controller) {

            // 1. 削除対象の処理
            if ($request->has('deleted_ids')) {
                foreach ($request->deleted_ids as $id) {
                    $banner = Banner::find($id);
                    if ($banner) {
                        $filePath = str_replace('storage/', 'public/', $banner->image);
                        if (Storage::exists($filePath)) {
                            Storage::delete($filePath);
                        }
                        $banner->delete();
                    }
                }
            }

            // 2. 更新・新規登録の処理
            foreach ($allKeys as $key) {
                $data = $bannersData[$key] ?? [];
                $file = $bannersFiles[$key]['image'] ?? null;

                // A. 新規登録
                if (!isset($data['id']) && $file) {
                    $controller->saveBanner($file);
                }
                // B. 既存更新
                elseif (isset($data['id']) && $file) {
                    $banner = Banner::find($data['id']);
                    if ($banner) {
                        $oldPath = str_replace('storage/', 'public/', $banner->image);
                        Storage::delete($oldPath);
                        $controller->saveBanner($file, $banner);
                    }
                }
            }

            return redirect()->route('admin.show.banner.edit');
        });
    }

    public function saveBanner(UploadedFile $file, $banner = null)
    {
        $fileName = $file->getClientOriginalName();
        $file->storeAs('public/images/banner', $fileName);
        $dbPath = 'storage/images/banner/' . $fileName;

        if ($banner) {
            // 更新の場合
            $banner->update(['image' => $dbPath]);
        } else {
            // 新規の場合
            Banner::create(['image' => $dbPath]);
        }
    }
}
