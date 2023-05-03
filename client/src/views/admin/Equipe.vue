<template>
    <div>
      <div class="flex flex-wrap">
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
          <card-ajout-equipe />
        </div>
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
          <card-equipe />
        </div>
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
          <card-equipe />
        </div>
        <div class="w-full xl:w-4/12 px-4">
          <card-bar-chart />
        </div>
        
      </div>
      
    </div>
  </template>
  <script>
  
  import CardEquipe from "@/components/Cards/CardEquipe.vue";
  import CardAjoutEquipe from "@/components/Cards/Ajouter/CardAjoutEquipe.vue";
  
  export default {
    name: "dashboard-page",
    components: {
      CardEquipe,
      CardAjoutEquipe,
     
    },
  };
  </script>
  