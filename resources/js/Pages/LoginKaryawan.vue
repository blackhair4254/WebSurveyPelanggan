<template>
     <!-- Navbar -->
    <nav class="bg-gradient-to-r from-white to-green-100">
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
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
        <div class="w-full max-w-md bg-white p-6 rounded-2xl shadow-md">
        <h1 class="text-xl font-bold text-gray-800 text-center mb-6">Login Karyawan</h1>

        <form @submit.prevent="handleLogin" class="space-y-5">
            <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input
                v-model="email"
                type="email"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
            />
            </div>

            <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input
                v-model="password"
                type="password"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
            />
            </div>

            <div>
            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition duration-200 shadow"
            >
                Login
            </button>
            </div>

            <p v-if="error" class="text-sm text-center text-red-500 mt-2">{{ error }}</p>
        </form>
        </div>
    </div>
    </template>

<script>
import axios from 'axios';
import { router } from '@inertiajs/vue3';



export default {
  name: 'LoginKaryawan',
  data() {
    return {
      email: '',
      password: '',
      error: null,
    };
  },
  methods: {
    async handleLogin() {
    try {
        const response = await axios.post('/api/karyawan/login', {
        email: this.email,
        password: this.password,
        });

        if (response.data.success) {
        localStorage.setItem('token', response.data.token);
        axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
        router.visit('/dashboard');
        } else {
        this.error = response.data.message || 'Login gagal.';
        }
    } catch (error) {
        this.error = 'Email atau password salah.';
    }
    }

  },
};
</script>

<style scoped>
</style>
