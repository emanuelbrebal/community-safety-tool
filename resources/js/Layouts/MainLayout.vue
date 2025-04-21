<template>
    <div class="min-h-screen flex flex-col">

      <header class="bg-blue-600 p-4 w-100">
        <h1 class="text-lg font-bold">Guardião da Vila</h1>
      </header>
  
      <main class="flex-1 p-6 w-80">
        <slot /> 
        
      </main>
  
      <footer class="bg-gray-100 text-center text-sm py-4 w-100">
        &copy; {{ new Date().getFullYear() }} - Todos os direitos reservados
      </footer>
    </div>
  </template>
  