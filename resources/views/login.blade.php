<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body>
        <main class="flex justify-center items-center w-screen h-screen">
            <div class="w-1/2 h-full flex justify-center items-center">
                <div class="p-10">
                    <div class="container-header mb-7">
                        <div class="font-semibold text-2xl mb-1 tracking-tight">
                            Selamat Datang 👋
                        </div>
                        <div class="text-md font-normal tracking-tight opacity-60">
                            Masukan Username dan Password untuk Login
                        </div>
                    </div>
                    <div class="container-form">
                        <form action="{{ route('login.action') }}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <div class="flex flex-col mb-4">
                                <label for="username" class="mb-1">Username</label>
                                <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="Enter your Username" class="text-md rounded-md p-2.5 outline-1 outline-primary border-2 border-gray-200  @error ('username') border-red-500 @enderror" required>
                                @error('username')<div class="text-md mt-1 italic text-red-500">{{ $message }}</div>@enderror
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="password" class="mb-1">Password</label>
                                <input type="password" name="password" id="password" placeholder="Enter your Password" class="text-md rounded-md p-2.5 outline-1 outline-primary border-2 border-gray-200  @error ('password') border-red-500 @enderror" required>
                                @error('password')<div class="text-md mt-1 italic text-red-600">{{ $message }}</div>@enderror
                            </div>
                            <button type="submit" class="w-full text- mt-5 p-2.5 text-fill outline-none border-none rounded-md bg-primary font-semibold">Login</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="w-1/2 h-full bg-primary bg-no-repeat bg-cover bg-center" style="background-image: url(/img/zilong.png)"></div>
        </main>
</body>
</html>