<template>
  <div
    class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-16"
    style="border-radius: 1rem;"
  >
    <img
      src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
      height="200px"
      cover
    />

    <div class="flex justify-center py-4 lg:pt-4 pt-8">
      <div class="mr-4 p-3 text-center">
        <span
          class="text-xl font-bold block uppercase tracking-wide text-blueGray-600"
        >
          22
        </span>
        <span class="text-sm text-blueGray-400">Matchs</span>
      </div>
      <div class="mr-4 p-3 text-center">
        <span
          class="text-xl font-bold block uppercase tracking-wide text-blueGray-600"
        >
          10
        </span>
        <span class="text-sm text-blueGray-400">Equipes</span>
      </div>
      <div class="lg:mr-4 p-3 text-center">
        <span
          class="text-xl font-bold block uppercase tracking-wide text-blueGray-600"
        >
          89
        </span>
        <span class="text-sm text-blueGray-400">Stades</span>
      </div>
    </div>

    <div class="text-center ">
      <h3 class="text-xl font-arial leading-normal mb-2 text-blueGray-700 mb-2">
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
          <i class="fas fa-plus"></i>
        </button>
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
</template>

<script>
export default {
  data: () => ({
    show: false,
  }),
};
</script>
