<script lang="ts" setup>
import {onMounted, reactive} from "vue";
import ApiResource from "@/api/api";

const apiResource = new ApiResource("website-setting");

const api = reactive({
    loading: true,
    list: [],
});

const fetchLists = async () => {
    api.loading = true;
    const { data } = await apiResource.list(api);
    api.list = data;
    api.loading = false;
};

onMounted(() => {
    fetchLists();
});
</script>
<template>
    <el-table v-loading="api.loading" :data="api.list" border>
        <el-table-column prop="name" label="Name" />
        <el-table-column prop="website" label="Website" />
        <el-table-column prop="facebook" label="Facebook" />
        <el-table-column prop="twitter" label="Twitter" />
        <el-table-column prop="instagram" label="Instagram" />
        <el-table-column prop="color" label="Color" />
        <el-table-column min-width="55" prop="header_background_image" label="Background Image">
            <template #default="scope">
                <img
                    :src="scope.row.header_background_image"
                    width="50"
                    height="40"
                    alt=""
                />
            </template>
        </el-table-column>
        <el-table-column min-width="55" prop="logo_full_path" label="Logo">
            <template #default="scope">
                <img
                    :src="scope.row.logo_full_path"
                    width="50"
                    height="40"
                    alt=""
                />
            </template>
        </el-table-column>
    </el-table>
</template>
