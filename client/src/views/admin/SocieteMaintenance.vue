<template>
    <div>
      <div class="flex flex-wrap">
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
          <card-ajout-ste/>
        </div>
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
          <card-ste/>
        </div>
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
          <card-ste />
        </div>
        <div class="w-full xl:w-4/12 px-4">
          <card-bar-chart />
        </div>
        
      </div>
      
    </div>
  </template>
  <script>
  
  import CardSte from "@/components/Cards/CardSte.vue";
  import CardAjoutSte from "@/components/Cards/Ajouter/CardAjoutSte.vue";
  
  export default {
    name: "dashboard-page",
    components: {
      CardSte,
      CardAjoutSte,
    },
  };
  </script>
  