<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Store;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    
     // Display the user's profile form.
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

     // Update the user's profile information.
     public function update(Request $request): RedirectResponse
     {
         // Validação dos dados enviados
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|max:255',
             'description' => 'nullable|string',
             'cnpj' => 'required|string|max:18',
             'imageURL' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'street' => 'required|string|max:255',
             'number' => 'required|string|max:10',
             'complement' => 'nullable|string|max:255',
             'neighborhood' => 'required|string|max:255',
             'city' => 'required|string|max:255',
             'state' => 'required|string|max:2',
             'postalCode' => 'required|string|max:10',
         ]);
     
         // Atualizando o perfil da loja
         $store = Store::find(auth()->id());  // Acha a loja pelo ID do usuário autenticado
         $store->name = $request->name;
         $store->email = $request->email;
         $store->description = $request->description;
         $store->cnpj = $request->cnpj;
     
         // Handle image upload
         if ($request->hasFile('imageURL')) {
             $imagePath = $request->file('imageURL')->store('stores', 'public');
             $store->imageURL = $imagePath;
         }
     
         $store->street = $request->street;
         $store->number = $request->number;
         $store->complement = $request->complement;
         $store->neighborhood = $request->neighborhood;
         $store->city = $request->city;
         $store->state = $request->state;
         $store->postalCode = $request->postalCode;
     
         // Salvando as alterações
         $store->save();
     
         // Registrando log para debug
         logger()->info('Store Atualizada:', $store->toArray());
     
         // Redirecionando para a página de edição do perfil com uma mensagem de sucesso
         return Redirect::route('profile.edit')->with('status', 'profile-updated');
     }
     

     // Delete the user's account.
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateImage(Request $request): JsonResponse
    {
        $request->validate([
            'imageURL' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $store = Store::find(auth()->id());

        if ($request->hasFile('imageURL')) {
            $imagePath = $request->file('imageURL')->store('stores', 'public');
            $store->imageURL = '/storage/' . $imagePath;
            $store->save();

            // Log for debugging
            logger()->info('Store image updated:', ['imageURL' => $store->imageURL]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'No image uploaded.']);
    }
}
