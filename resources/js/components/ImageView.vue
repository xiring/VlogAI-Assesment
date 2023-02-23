<script lang="ts" setup>
  import {reactive, onMounted} from "vue";

  import ImageResource from "@/api/api";

  const imageResource = new ImageResource("website-setting");

  const api = reactive({
      loading: true,
      image: "",
  });

  const fetchImage = async () => {
      api.loading = true;
      const { data } = await imageResource.get(1);
      api.image = data;
      api.loading = false;
  };

  onMounted(() => {
      fetchImage();
  });
</script>
<template>
  <h1>image</h1>
</template>
