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

    <div class="p-4 max-w-xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Survei Kepuasan Pelanggan</h1>
        <form @submit.prevent="submitSurvey">
            <!-- Step 0: Nama -->
            <div v-if="step === 0" class="mb-3">
            <label>Nama Anda</label>
            <input
                v-model="form.nama"
                type="text"
                class="w-full border p-2 rounded"
                :class="{ 'border-red-500': namaError }"
                required
            />
            <p v-if="namaError" class="text-red-600 text-sm mt-1">{{ namaError }}</p>
            </div>

            <!-- Step 1-n: Pertanyaan Skala 1-5 -->
            <div v-if="step >= 1 && step <= pertanyaanKeys.length" class="mb-6">
                <div class="flex items-start gap-6">
                    <!-- Pertanyaan -->
                    <label class="w-1/2 text-lg font-semibold">
                    {{ pertanyaan[pertanyaanKeys[step - 1]] }}
                    </label>

                    <!-- Opsi jawaban horizontal -->
                    <div class="flex justify-start gap-4 w-1/2">
                        <div
                            v-for="option in opsiSkalaPerPertanyaan[pertanyaanKeys[step - 1]]"
                            :key="option.value"
                            class="text-center"
                        >
                            <div class="text-xl">{{ option.emoji }}</div>
                            <input
                            type="radio"
                            :value="option.value"
                            :name="pertanyaanKeys[step - 1]"
                            v-model="form[pertanyaanKeys[step - 1]]"
                            class="accent-blue-600 mt-1"
                            />
                            <div class="text-xxxl">{{ option.label }}</div>
                        </div>
                    </div>
                </div>
            </div>



      <!-- Step setelah pertanyaan skala: NPS -->
      <div v-if="step === pertanyaanKeys.length + 1" class="mb-3">
        <label>Seberapa besar kemungkinan Anda merekomendasikan kami? (0-10)</label>
        <input type="number" v-model="form.nps" min="0" max="10" class="w-full border p-2 rounded" required />
      </div>

      <!-- Step terakhir: Saran -->
      <div v-if="step === pertanyaanKeys.length + 2" class="mb-3">
        <label>Saran dan Masukan</label>
        <textarea v-model="form.saran" class="w-full border p-2 rounded"></textarea>
      </div>

      <!-- Navigasi -->
      <div class="flex justify-between mt-4">
        <button v-if="step > 0" type="button" class="bg-gray-300 px-4 py-2 rounded" @click="step--">Kembali</button>

        <button
          v-if="step < pertanyaanKeys.length + 2"
          type="button"
          class="bg-blue-600 text-white px-4 py-2 rounded ml-auto"
          @click="nextStep"
        >
          Berikutnya
        </button>

        <button
          v-if="step === pertanyaanKeys.length + 2"
          type="submit"
          class="bg-green-600 text-white px-4 py-2 rounded ml-auto"
        >
          Kirim
        </button>
      </div>
    </form>

    <p v-if="success" class="text-green-600 mt-4">{{ success }}</p>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

// Data form
const form = ref({
  nama: '',
  kualitas_produk: 0,
  pelayanan: 5,
  pengiriman: 5,
  kemudahan_transaksi: 5,
  harga_nilai: 5,
  after_sales: 5,
  kepuasan_umum: 5,
  nps: 9,
  saran: ''
})

const namaError = ref('')
const success = ref('')
const step = ref(0)
const opsiSkalaPerPertanyaan = {
  kualitas_produk: [
    { value: 5, label: 'Sangat Bagus', emoji: '😊' },
    { value: 4, label: 'Bagus', emoji: '😍' },
    { value: 3, label: 'Netral', emoji: '😐' },
    { value: 2, label: 'Buruk', emoji: '😞' },
    { value: 1, label: 'Sangat Buruk', emoji: '😠' }
  ],
  pelayanan: [
    { value: 5, label: 'Sangat Bagus', emoji: '😊' },
    { value: 4, label: 'Bagus', emoji: '😍' },
    { value: 3, label: 'Netral', emoji: '😐' },
    { value: 2, label: 'Buruk', emoji: '😞' },
    { value: 1, label: 'Sangat Buruk', emoji: '😠' }
  ],
  pengiriman: [
    { value: 5, label: 'Sangat Setuju', emoji: '✅' },
    { value: 4, label: 'Setuju', emoji: '☑️' },
    { value: 3, label: 'Netral', emoji: '-' },
    { value: 2, label: 'Tidak Setuju', emoji: '✖️' },
    { value: 1, label: 'Sangat Tidak Setuju', emoji: '❌' }
  ],
  kemudahan_transaksi: [
    { value: 5, label: 'Sangat Setuju', emoji: '✅' },
    { value: 4, label: 'Setuju', emoji: '☑️' },
    { value: 3, label: 'Netral', emoji: '-' },
    { value: 2, label: 'Tidak Setuju', emoji: '✖️' },
    { value: 1, label: 'Sangat Tidak Setuju', emoji: '❌' }
  ],
  harga_nilai: [
    { value: 5, label: 'Sangat Setuju', emoji: '✅' },
    { value: 4, label: 'Setuju', emoji: '☑️' },
    { value: 3, label: 'Netral', emoji: '-' },
    { value: 2, label: 'Tidak Setuju', emoji: '✖️' },
    { value: 1, label: 'Sangat Tidak Setuju', emoji: '❌' }
  ],
  after_sales: [
    { value: 5, label: 'Sangat Bagus', emoji: '😊' },
    { value: 4, label: 'Bagus', emoji: '😍' },
    { value: 3, label: 'Netral', emoji: '😐' },
    { value: 2, label: 'Buruk', emoji: '😞' },
    { value: 1, label: 'Sangat Buruk', emoji: '😠' }
  ],
  kepuasan_umum: [
    { value: 5, label: 'Sangat Puas', emoji: '😊' },
    { value: 4, label: 'Puas', emoji: '🥰' },
    { value: 3, label: 'Netral', emoji: '😐' },
    { value: 2, label: 'Tidak Puas', emoji: '🙁' },
    { value: 1, label: 'Sangat Tidak Puas', emoji: '😣' }
  ]
};



const pertanyaan = {
  kualitas_produk: 'Bagaimana kualitas produk kami ?',
  pelayanan: 'Bagaimana pelayanan staf kami ?',
  pengiriman: 'Apakah pengiriman selalu tepat waktu ?',
  kemudahan_transaksi: 'Apakah proses pemesanan sangat mudah ?',
  harga_nilai: 'Apakah harga sesuai dengan kualitas ?',
  after_sales: 'Bagaimana pelayanan after sales kami ?',
  kepuasan_umum: 'Seberapa puas Anda secara keseluruhan ?'
}

const pertanyaanKeys = Object.keys(pertanyaan)

const nextStep = () => {
  if (step.value === 0) {
    if (!form.value.nama.trim()) {
      namaError.value = 'Nama wajib diisi.'
      return
    } else {
      namaError.value = ''
    }
  }

  if (step.value < pertanyaanKeys.length + 2) {
    step.value++
  }
}

const submitSurvey = async () => {
  try {
    await axios.post('/api/survey', form.value)
    success.value = 'Terima kasih atas partisipasi Anda!'
    step.value = 0
    form.value = {
      nama: '',
      kualitas_produk: 5,
      pelayanan: 5,
      pengiriman: 5,
      kemudahan_transaksi: 5,
      harga_nilai: 5,
      after_sales: 5,
      kepuasan_umum: 5,
      nps: 5,
      saran: ''
    }
  } catch (err) {
    console.error(err)
  }
}
</script>
