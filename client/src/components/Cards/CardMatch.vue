<template>
  <div
    class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-16" style="
      border-radius: 1rem;"
  >
    <div class="px-6">
      
      <div class="flex flex-wrap justify-center" >
        <h3 style="padding-top:2rem; margin-bottom: -1.5rem;"
          class="text-2xl font-semibold font-arial leading-normal mb-2 text-blueGray-700 mb-2"
        >
          Derby
        </h3>
        <div class="w-full px-4 text-center mt-20">
            <div class="flex justify-center py-4 lg:pt-4 pt-8">
              <div style="padding-left:2.4rem;" class="mr-4 p-3 text-center">
                    <img
                    alt="..."
                    :src="team3"
                    class="shadow-xl rounded-full  border-none absolute -m-16 lg:-ml-18 max-w-100-px"
                    />
                    <br>
                    <br>
                    <span class="text-sm text-blueGray-400">ES Tunis</span>
              </div>
              <div class="mr-4 p-3 text-center">
                <span class="text-sm text-blueGray-400" style="padding-left:0.6rem;">VS</span>
              </div>
              <div class="mr-4 p-3 text-center">
                    <img
                    alt="..."
                    :src="team2"
                    class="shadow-xl rounded-full  border-none absolute -m-16 lg:-ml-19 max-w-100-px"
                    />
                    <br>
                    <br>
                    <span class="text-sm text-blueGray-400">club affricain</span>
              </div>
            </div>
        </div>
      </div>
      <div class="text-center mt-52">
        
        <div class="mb-2 text-xs text-blueGray-600 mt-25">
          <i class="fa fa-clock mr-2 text-sm"></i>
          De 04-02-2023 A 10-02-2023
        </div>
        <div class="mb-2 text-xs text-blueGray-600 mt-25">
          <i class="fas fa-map-marker-alt mr-2 text-sm"></i>
          Los Angeles, California
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
          <button
            class="bg-white-500 text-black-200 active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
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
import team2 from "@/assets/img/CA.jpg";
import team3 from "@/assets/img/est.jpg";

export default {
  data() {
    return {
      team2,
      team3,
    };
  },
};
</script>
