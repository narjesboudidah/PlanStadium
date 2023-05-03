<template>
    <div>
      <div class="flex flex-wrap">
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
          <card-ajout-stade/>
        </div>
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
          <card-stade/>
        </div>
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
          <card-stade />
        </div>
        <div class="w-full xl:w-4/12 px-4">
          <card-bar-chart />
        </div>
        
      </div>
      
    </div>
  </template>
  <script>
  
  import CardStade from "@/components/Cards/CardStade.vue";
  import CardAjoutStade from "@/components/Cards/Ajouter/CardAjoutStade.vue";
  
  export default {
    name: "dashboard-page",
    components: {
      CardStade,
      CardAjoutStade,
     
    },
  };
  </script>
  