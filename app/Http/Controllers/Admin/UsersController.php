<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Register;
use App\Models\File;
use App\Models\Role;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function status(int $id, string $status)
    {
        User::findOrFail($id)->update(['status' => $status]);
        return back();
    }

    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        if($request->file_input){
            foreach ($user->photos as $photo){
                Storage::delete(str_replace('/storage/', '', $photo->src));
                $photo->delete();
            }

            foreach ($request->file_input as $file){
                //удаляем старый добалвяем новый
                $path = $file->store('photos', 'public');
                File::create(
                    [
                        'fileable_type' => 'App\Models\User',
                        'fileable_id' => $user->id,
                        'category' => 'photo',
                        'src' => '/storage/'.$path
                    ]
                );
            }
        }

        if($user->shop) {
            $user->shop->update([
                'title' => $request->shop_name,
                'description' => $request->shop_description,
                'shipping_info' => $request->shop_shipping,
                'communication_info' => $request->shop_communication_info
            ]);
        }

        return back();
    }

    public function rating(Request $request, int $id)
    {
        User::findOrFail($id)->update(['rating' => $request->rating]);
        return back();
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => Role::where('tech_name', 'seller')->pluck('id')->first()
        ]);

        $path = $request->img->store('photos', 'public');
        File::create(
            [
                'fileable_type' => 'App\Models\User',
                'fileable_id' => $user->id,
                'category' => 'photo',
                'src' => '/storage/'.$path
            ]
        );

        Mail::to(['email' => $request->email])->send(new Register($request->email, $request->password));

        Shop::create([
            'title' => $request->shop_name,
            'description' => $request->shop_description,
            'shipping_info' => $request->shop_shipping,
            'communication_info' => $request->shop_communication_info,
            'user_id' => $user->id
        ]);

        return back();
    }
}
