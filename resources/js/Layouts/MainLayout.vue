<template>
    <div class="min-h-screen flex flex-col">
      <!-- Header -->
      <header class="bg-blue-600 text-white p-4 w-100">
        <h1 class="text-lg font-bold">Minha Aplicação</h1>
      </header>
  
      <!-- Conteúdo principal -->
      <main class="flex-1 p-6">
        <slot /> 
        
      </main>
  
      <!-- Rodapé -->
      <footer class="bg-gray-100 text-center text-sm py-4 w-100">
        &copy; {{ new Date().getFullYear() }} - Todos os direitos reservados
      </footer>
    </div>
  </template>
  