<template>
  <div
    class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-16"
    style="border-radius: 1rem"
  >
    <div class="px-6">
      <div class="flex flex-wrap justify-center">
        <div class="w-full px-4 flex justify-center">
          <div class="relative">
            <img
              alt="..."
              :src="logoRealMadrid"
              class="shadow-xl rounded-full h-auto align-middle absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px"
              style="border: 0.5rem solid #fff"
            />
          </div>
        </div>
      </div>
      <div class="text-center mt-21">
        <h3 
          class="text-xl font-arial leading-normal mb-2 text-blueGray-700 mb-2"
        >
          Real Madrid
        </h3>
        <div class="mb-2 text-xs text-blueGray-600 mt-25">
          <i class="fa fa-user mr-2 text-sm"></i>
          Florentino Perez
        </div>
        <div class="mb-2 text-xs text-blueGray-600 mt-25">
          <i class="fas fa-map-marker-alt mr-2 text-lg"></i>
          Avenida de las Fuerzas Armadas 402 - 28055 Madrid.
        </div>
      </div>
      <div class="mt-50 py-3 border-t border-blueGray-200 text-center">
        <div class="flex flex-wrap justify-center">
          
          <button
            class="bg-white-500 text-black-200 active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
            type="button"
          >
            <i class="fas fa-pen"></i>
          </button>
          <button
            class="bg-white-500 text-black-200 active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
            type="button"
          >
            <i class="fa fa-ban"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import logoRealMadrid from "@/assets/img/Real-Madrid.png";

export default {
  data() {
    return {
      logoRealMadrid,
    };
  },
};
</script>
