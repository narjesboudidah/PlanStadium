<template>
  <div class="flex flex-wrap mt-4">
    <div class="w-full mb-12 px-4">
      <card-demande-m />
    </div>
    <div class="w-full mb-12 px-4">
      <card-demande />
    </div>

    <div id="card-reservation" class="w-full mb-12 px-4">
      <card-table color="dark" />
    </div>
  </div>
</template>
<script>
import CardDemande from "@/components/Cards/CardDemande.vue";
import CardDemandeM from "@/components/Cards/CardDemandeM.vue";

export default {
  components: {
    CardDemande,
    CardDemandeM,
  },
};
</script>
