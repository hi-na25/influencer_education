<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

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
        // 1. 削除対象の処理（「ー」ボタンで消されたIDのリストが届く想定）
        if ($request->has('deleted_ids')) {
            foreach ($request->deleted_ids as $id) {
                $banner = Banner::find($id);
                if ($banner) {
                    // 1. サーバー内の画像ファイルを削除
                    // DBには "storage/images/banner/filename.jpg" という形式で入っている。
                    // Storage::delete() を使うときは "public/images/banner/filename.jpg" というパスにする必要があるから変換する。
                    $filePath = str_replace('storage/', 'public/', $banner->image);

                    if (Storage::exists($filePath)) {
                        Storage::delete($filePath);
                    }

                    // 2. データベースのレコードを削除
                    $banner->delete();
                }
            }
        }

        // 2. データの取得
        $bannersData = $request->input('banners', []);
        $bannersFiles = $request->file('banners', []);

        // ★修正ポイント：テキストデータとファイルの「すべてのキー」を合体させてループ回す
        $allKeys = array_unique(array_merge(array_keys($bannersData), array_keys($bannersFiles)));

        foreach ($allKeys as $key) {
            $data = $bannersData[$key] ?? [];
            $file = $bannersFiles[$key]['image'] ?? null;

            // A. 新規登録（IDがなくて、ファイルがある場合）
            if (!isset($data['id']) && $file) {
                $this->saveBanner($file);
            }

            // B. 既存更新（IDがあって、新しいファイルが選ばれた場合のみ）
            elseif (isset($data['id']) && $file) {
                $banner = Banner::find($data['id']);
                if ($banner) {
                    // 古いファイルを消してから更新
                    $oldPath = str_replace('storage/', 'public/', $banner->image);
                    \Illuminate\Support\Facades\Storage::delete($oldPath);

                    $this->saveBanner($file, $banner);
                }
            }
        }

        return redirect()->route('admin.show.banner.edit')->with('success', '更新完了！');
    }


    // 保存処理を共通化したプライベートメソッド
    private function saveBanner(UploadedFile $file, $banner = null)
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
