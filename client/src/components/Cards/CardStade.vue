<template>
  <div
    class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-16" style="
      border-radius: 1rem;"
  >
    <div class="px-6">
      <div class="flex flex-wrap justify-center">
        <div class="w-full px-4 flex justify-center">
          <div class="relative">
            <img 
              alt="..."
              :src="stade"
              class="shadow-xl rounded-full h-auto align-middle absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px" style="border: 0.5rem solid #fff;"
            />
         </div>
        </div>
        <div class="w-full px-4 text-center mt-21">
          <div class="text-center mt-52">
            <h3 
              class="text-xl font-arial leading-normal mb-2 text-blueGray-700 mb-2 font-semibold"
            >
              Olympique de Radès
            </h3>
            <div class="mb-2 text-xs text-blueGray-600 mt-25">
              <i style="transform: rotate(90deg)" class="fa fa-phone mr-2 text-sm"></i>
                +216 77877876
            </div>
          </div>
          <div class="flex justify-center py-4 lg:pt-4 pt-8">
            <div class="mr-4 p-3 text-center">
              <span
                class="text-xl font-bold block uppercase tracking-wide text-blueGray-600"
              >
                22
              </span>
              <span class="text-sm text-blueGray-400">Capacite</span>
            </div>
            <div class="mr-4 p-3 text-center">
              <span
                class="text-xl font-bold block uppercase tracking-wide text-blueGray-600"
              >
                10
              </span>
              <span class="text-sm text-blueGray-400">Surface</span>
            </div>
            <div class="lg:mr-4 p-3 text-center">
              <span
                class="text-xl font-bold block uppercase tracking-wide text-blueGray-600"
              >
                89
              </span>
              <span class="text-sm text-blueGray-400">Matchs</span>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-50 py-3 border-t border-blueGray-200 text-center">
        <div class="flex flex-wrap justify-center">
          <button
            class="bg-white-500 text-blueGray-700 active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
            type="button"
          > 
          <router-link
              to="/form/AjoutStade"
              v-slot="{href,navigate, isActive }"
            >
              <a
                 style="font-family: inherit,serif;font-size: 15px;"
                :href=href
                @click="navigate"
                class=""
                :class="[
                  isActive
                    ? 'box-sidebar hover:text-red-600 '
                    : 'hover:text-blueGray-500',
                ]"
              >
            <i class="fas fa-plus"></i>
              </a>
              </router-link>
          </button>
          <button
            class="bg-white-500 text-blueGray-700 active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
            type="button"
          >
            <i class="fas fa-pen"></i>
          </button>
          <button
            class="bg-white-500 text-blueGray-700 active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
            type="button"
          >
            <i class="fa fa-ban"></i>
          </button>
          <button
            class="bg-white-500 text-blueGray-700 active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
            type="button"
          >
            <i class="fa fa-list"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import stade from "@/assets/img/stade.jpg";

export default {
  data() {
    return {
      stade,
    };
  },
};
</script>
