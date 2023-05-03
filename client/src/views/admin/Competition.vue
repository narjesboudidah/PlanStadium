<template>
    <div>
      <div class="flex flex-wrap">
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
          <card-ajout-competition />
        </div>
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
          <card-competition />
        </div>
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
          <card-competition />
        </div>
        <div class="w-full xl:w-4/12 px-4">
          <card-bar-chart />
        </div>
        
      </div>
      
    </div>
  </template>
  <script>
  
  import CardCompetition from "@/components/Cards/CardCompetition.vue";
  import CardAjoutCompetition from "@/components/Cards/Ajouter/CardAjoutCompetition.vue";
  
  
  export default {
    name: "dashboard-page",
    components: {
      CardCompetition,
      CardAjoutCompetition,
     
    },
  };
  </script>
  