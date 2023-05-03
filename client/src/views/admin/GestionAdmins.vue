<template>
    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <card-tableA />
      </div>
    </div>
  </template>
  <script>
  import CardTableA from "@/components/Cards/CardTableA.vue";
  
  export default {
    components: {
      CardTableA,
    },
  };
  </script>