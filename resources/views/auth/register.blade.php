<!DOCTYPE html>
<html>

<head>
 
    @include('home.css')
    <style>
        .social-login {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .social-login a {
            text-decoration: none;
            color: #fff;
            margin: 0 10px;
            padding: 10px 15px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            font-size: 16px;
            font-weight: 500;
        }
        .social-login a.google {
            background: #db4437;
        }
        .social-login a i {
            margin-right: 8px;
        }
    </style>

</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @php
        $count=0;
    @endphp
    @include('home.header')
   
    <x-guest-layout>
        <form method="POST" action="{{ route('register') }}">
            @csrf
    
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
             <!-- Phone -->
             <div>
                <x-input-label for="phone" :value="__('phone')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
    
             <!-- Address -->
             <div>
                <x-input-label for="address" :value="__('address')" />
                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
    
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
    
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
    
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
    
            <div class="flex items-center justify-end mt-4">
               

                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
    
                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
            
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="text-muted mb-3">OR</h5>
                    
                    <a href="{{route('auth.google')}}" class="btn btn-outline-danger btn-block d-flex align-items-center justify-content-center">
                        <i class="fab fa-google me-2 px-4"></i> Sign Up with Google
                    </a>
                  
                </div>
            </div>
            
        </form>
    </x-guest-layout>
    

  <!-- info section -->
  @include('home.footer')
</body>

</html>