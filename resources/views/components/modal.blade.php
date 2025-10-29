<div id="bg-gray" class="hidden bg-[rgba(0,0,0,0.6)] fixed inset-0 flex justify-center items-center z-50"></div>

<div id="modal-container" class="m-2 hidden fixed inset-0 flex justify-center items-center z-50">
  <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl p-8 relative animate-fadeIn">
    
    <!-- Close Button -->
    <button onclick="closeModalAssociateFeeder()"
            class="absolute top-5 right-5 text-gray-400 hover:text-gray-600 transition text-2xl font-bold">
      &times;
    </button>
    
    <!-- Header -->
    <h2 class="text-3xl font-bold text-gray-900 mb-4 text-center md:text-left">
      Associar Alimentador
    </h2>
    
    <!-- Description -->
    <p class="text-gray-600 mb-6 text-center md:text-left">
      Insere o ID do alimentador que queres associar à tua conta.
    </p>
    
    <!-- Input -->
    <div class="relative mb-6 mx-auto md:mx-0">

      <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg">🔗</span>
      <input type="text" placeholder="ID do alimentador"
             class="w-full pl-12 pr-4 py-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black transition text-gray-900 placeholder-gray-400"/>
    </div>
    
    <!-- Submit Button -->
    <div class="mx-auto md:mx-0">
      <button class="bg-black hover:bg-gray-900 transition-all duration-300 text-white font-semibold px-6 py-4 rounded-lg w-full transform">
        Associar
      </button>
    </div>
  </div>
</div>

<script>
    const bg_gray = document.getElementById('bg-gray');
    const modal_container = document.getElementById('modal-container');
    
    function openModalAssociateFeeder() {
        bg_gray.classList.remove('hidden');
        modal_container.classList.remove('hidden');
    }

    function closeModalAssociateFeeder() {
        bg_gray.classList.add('hidden');
        modal_container.classList.add('hidden');
    }

    bg_gray.addEventListener('click', closeModalAssociateFeeder);
</script>
