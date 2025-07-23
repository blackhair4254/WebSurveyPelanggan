<template>
  <div class="min-h-screen bg-gray-100 py-8 px-4">
    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6 space-y-6">
        <!-- Header dengan Logout -->
      <div class="flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-gray-800">Report Survey</h1>
        <a
          href="/"
          class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition inline-block"
        >
          Logout
        </a>
      </div>

        
      <!-- Filter tanggal -->
  <div class="flex flex-wrap gap-4 items-end">
    <div>
      <label class="block text-sm font-medium text-gray-700">Dari</label>
      <input type="date" v-model="startDate" class="mt-1 block w-full border-gray-300 rounded-md" />
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700">Sampai</label>
      <input type="date" v-model="endDate" class="mt-1 block w-full border-gray-300 rounded-md" />
    </div>
    <button @click="fetchSummary" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
      Filter
    </button>
  </div>

  <!-- CSAT score -->
  <div class="text-center py-8 bg-gray-50 rounded-lg">
    <p class="text-gray-600 mb-2">Rata‑rata CSAT</p>
    <p class="text-6xl font-bold text-green-600">{{ csat ?? '--' }}</p>
    <p class="text-sm text-gray-500 mt-1">(dari {{ count }} respon)</p>
  </div>

  <!-- Detail Responden -->
    <div>
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Detail Responden</h2>
    <div v-if="responses.length" class="space-y-4">
        <div
        v-for="resp in responses"
        :key="resp.id"
        class="p-4 border rounded-lg bg-white space-y-2"
        >
        <div class="flex justify-between items-center">
            <p><span class="font-semibold">Nama:</span> {{ resp.nama }}</p>
        </div>

        <div class="flex justify-between items-center">
            <p><span class="font-semibold">Kualitas Produk:</span> {{ resp.kualitas_produk }}</p>
            <button @click="onEditField(resp, 'kualitas_produk')" class="text-sm text-blue-600 hover:underline">Edit</button>
        </div>

        <div class="flex justify-between items-center">
            <p><span class="font-semibold">Pelayanan:</span> {{ resp.pelayanan }}</p>
            <button @click="onEditField(resp, 'pelayanan')" class="text-sm text-blue-600 hover:underline">Edit</button>
        </div>

        <div class="flex justify-between items-center">
            <p><span class="font-semibold">Pengiriman:</span> {{ resp.pengiriman }}</p>
            <button @click="onEditField(resp, 'pengiriman')" class="text-sm text-blue-600 hover:underline">Edit</button>
        </div>

        <div class="flex justify-between items-center">
            <p><span class="font-semibold">Kemudahan Transaksi:</span> {{ resp.kemudahan_transaksi }}</p>
            <button @click="onEditField(resp, 'kemudahan_transaksi')" class="text-sm text-blue-600 hover:underline">Edit</button>
        </div>

        <div class="flex justify-between items-center">
            <p><span class="font-semibold">Harga vs Nilai:</span> {{ resp.harga_nilai }}</p>
            <button @click="onEditField(resp, 'harga_nilai')" class="text-sm text-blue-600 hover:underline">Edit</button>
        </div>

        <div class="flex justify-between items-center">
            <p><span class="font-semibold">After-Sales:</span> {{ resp.after_sales }}</p>
            <button @click="onEditField(resp, 'after_sales')" class="text-sm text-blue-600 hover:underline">Edit</button>
        </div>

        <div class="flex justify-between items-center">
            <p><span class="font-semibold">Kepuasan Umum:</span> {{ resp.kepuasan_umum }}</p>
            <button @click="onEditField(resp, 'kepuasan_umum')" class="text-sm text-blue-600 hover:underline">Edit</button>
        </div>

        <div class="flex justify-between items-center">
            <p><span class="font-semibold">NPS:</span> {{ resp.nps }}</p>
            <button @click="onEditField(resp, 'nps')" class="text-sm text-blue-600 hover:underline">Edit</button>
        </div>

        <div class="flex justify-between items-center">
            <p><span class="font-semibold">Saran:</span> {{ resp.saran || '-' }}</p>
        </div>

        <p class="text-xs text-gray-500 mt-1">{{ formatDate(resp.created_at) }}</p>

        <div class="flex gap-2 mt-2">
            <button @click="onDelete(resp.id)" class="text-red-600 hover:underline">Hapus</button>
        </div>
        </div>
    </div>
    <p v-else class="text-center text-gray-500">Tidak ada data responden.</p>
  </div>
</div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const startDate = ref('')
const endDate   = ref('')
const csat       = ref(null)
const count      = ref(0)
const responses  = ref([])

async function fetchSummary() {
  try {
    const { data } = await axios.get('/api/survey/summary', {
      params: { start: startDate.value, end: endDate.value }
    })
    csat.value      = data.csat
    count.value     = data.count
    responses.value = data.responses
  } catch (e) {
    console.error('Fetch summary error', e)
  }
}

function formatDate(dt) {
  return new Date(dt).toLocaleDateString('id-ID', {
    year:  'numeric',
    month: 'long',
    day:   'numeric'
  })
}

async function onDelete(id) {
  if (!confirm('Yakin ingin menghapus survey ini?')) return;
  await axios.delete(`/api/survey/${id}`)
  fetchSummary()
}

/**
 * Edit satu field saja.
 * resp: objek survey, field: nama field yang diedit
 */
async function onEditField(resp, field) {
  const current = resp[field] ?? ''
  let message  = `Masukkan nilai baru untuk ${field.replace('_', ' ')}`
  // untuk Saran, default text, bukan number
  const isText = field === 'saran'
  const input = prompt(message, current)
  if (input === null) return

  const payload = isText
    ? { [field]: input }
    : { [field]: Number(input) }

  try {
    await axios.put(`/api/survey/${resp.id}`, payload)
    fetchSummary()
  } catch (e) {
    console.error('Update gagal', e)
  }
}

onMounted(fetchSummary)
</script>