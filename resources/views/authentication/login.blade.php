<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  @vite('resources/css/app.css')
</head>

<body class="bg-[#DEE1DD]">
  <div class="container-fluid h-dvh content-center w-dvw">
    <form action="{{ route('login')}}" method="get" class="max-w-md m-auto p-14 pb-5 bg-[#C4CDC1] rounded-lg">
      @csrf
      <div class="grid justify-items-center">
        <h1 class="text-3xl font-bold mb-10">LOGIN</h1>
      </div>
      <div class="relative z-0 w-full mb-5 group">
        <input type="email" name="email" id="floating_email"
          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-900 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
          placeholder=" " required />
        <label for="floating_email"
          class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
          address</label>
      </div>
      <div class="relative z-0 w-full mb-5 group">
        <input type="password" name="password" id="floating_password"
          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-900 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
          placeholder=" " required />
        <label for="floating_password"
          class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
      </div>
      @if (session('error'))
      <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
      {{ session('error')}}
      </div>
    @endif
      @if (session('success'))
      <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
      role="alert">
      {{ session('success')}}
      </div>
    @endif
      <div class="relative mt-14 z-0 w-full mb-5 group">
        <button type="submit"
          class="inline-block text-white bg-[#2F575D] hover:bg-[#103A38] focus:ring-4 focus:outline-none focus:ring-[#0A3431] font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-[#2F575D] dark:hover:bg-[#103A38] dark:focus:ring-[#0A3431]">Login</button>
      </div>
      <div class="relative z-0 w-full mb-5 group text-center">
        Don't have an account? <span><a href="{{ route('accounts.create')}}"
            class="font-medium underline underline-offset-2">Sign up</a></span>
      </div>
      <div class="grid z-0 w-full mb-3 mt-4 group justify-items-center">
        <img src="{{asset('asset/profile-circle.256x256.png')}}" class="w-[50px] h-[50px]" alt="logo gereja">
      </div>
    </form>
  </div>

  <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
  @vite('resources/js/app.js')
</body>

</html>