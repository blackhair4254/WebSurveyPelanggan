<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <div class="flex items-center">
            <img
              src="https://floo.co.id/assets/src/floo-landscape.png"
              alt="Logo"
              class="h-10 w-auto mr-4"
            />
            <div class="hidden md:flex space-x-4">
              <a
                href="/"
                class="text-gray-800 hover:text-blue-600 font-medium transition"
              >
                Beranda
              </a>
              <a
                href="/survey-form"
                class="text-gray-800 hover:text-blue-600 font-medium transition"
              >
                Survey
              </a>
              <a
                href="/karyawan"
                class="text-gray-800 hover:text-blue-600 font-medium transition"
              >
                Login
              </a>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- Content -->
    <header class="bg-gradient-to-r from-green-600 to-green-700 py-24">
      <div class="max-w-4xl mx-auto px-6 text-center text-white">
        <h1 class="text-4xl font-bold mb-4">Selamat Datang di Layanan Survey Kepuasan</h1>
        <p class="text-lg mb-6">Bantu kami meningkatkan kualitas layanan melalui partisipasi Anda dalam survey.</p>
        <a
          href="/survey-form"
          class="bg-white text-green-700 font-semibold px-6 py-3 rounded-full shadow hover:bg-gray-100 transition"
        >
          Isi Survey Sekarang
        </a>
      </div>
    </header>

    <section class="py-16 px-6 max-w-5xl mx-auto">
      <h2 class="text-2xl font-bold text-center mb-8 text-gray-800">Kenapa Kami Perlu Feedback Anda?</h2>
      <div class="grid md:grid-cols-3 gap-8 text-center">
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
          <h3 class="text-xl font-semibold mb-2">Tingkatkan Layanan</h3>
          <p class="text-gray-600">Kami selalu ingin memberikan yang terbaik kepada pelanggan kami.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
          <h3 class="text-xl font-semibold mb-2">Perbaiki Kekurangan</h3>
          <p class="text-gray-600">Feedback Anda membantu kami menemukan area yang perlu diperbaiki.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
          <h3 class="text-xl font-semibold mb-2">Berdayakan Pengguna</h3>
          <p class="text-gray-600">Kami percaya pelanggan berperan penting dalam membentuk masa depan kami.</p>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>

</script>
