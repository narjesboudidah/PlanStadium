<template>
    <div>
      <div class="flex flex-wrap">
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
          <card-test-stade/>
        </div>
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
          <card-stade/>
        </div>
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
          <card-test-stade />
        </div>
        <div class="w-full xl:w-4/12 px-4">
          <card-test-chart />
        </div>
        
      </div>
      
    </div>
  </template>
  <script>
  
  import CardTestStade from "@/components/Cards/CardTestStade.vue";
  
  export default {
    name: "dashboard-page",
    components: {
      CardTestStade,
     
    },
  };
  </script>
  