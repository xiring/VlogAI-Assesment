<script lang="ts" setup>
import {ref, reactive, onMounted} from "vue";
//Components
import type { FormInstance, FormRules } from "element-plus";
import { ElMessage } from "element-plus";
import Upload from "./Uploads/SingleImage.vue";

import ApiResource from "@/api/api";

const apiResource = new ApiResource("website-setting");

const dialogFormVisible = ref<boolean>(false);

let ruleFormRef = ref<FormInstance>();

let addForm = reactive({
    name: "",
    website: "",
    facebook: "",
    twitter: "",
    instagram: "",
    color: "",
    header_background_image: "",
    logo: ""
});


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

const rules = reactive<FormRules>({
    name: [
        { required: true, message: "Name is required", trigger: "blur" },
        { min: 3, message: "Length should be greater than 3", trigger: "blur" },
    ],
    website: [
        { required: true, message: "Website is required", trigger: "blur" },
        { type: "url", message: "Type should be url", trigger: "blur" },
    ],
    facebook: [
        { required: true, message: "Website is required", trigger: "blur" },
        { type: "url", message: "Type should be url", trigger: "blur" },
    ],
    twitter: [
        { required: true, message: "Website is required", trigger: "blur" },
        { type: "url", message: "Type should be url", trigger: "blur" },
    ],
    instagram: [
        { required: true, message: "Website is required", trigger: "blur" },
        { type: "url", message: "Type should be url", trigger: "blur" },
    ],
    logo: [
        { required: true, message: "Logo is required", trigger: "blur" },
    ],
    header_background_image: [
        { required: true, message: "Search Term is required", trigger: "blur" },
    ],
});

const submitForm = async (formEl: FormInstance | undefined) => {
    if (!formEl) return;
    await formEl.validate((valid, fields) => {
        if (valid) {
            apiResource.store(addForm).then((response) => {
                ElMessage({
                    message: "Form Submitted Successfully!!",
                    type: "success",
                });
                dialogFormVisible.value = false;
                addForm.name = '';
                addForm.website = '';
                addForm.facebook = '';
                addForm.twitter = '';
                addForm.instagram = '';
                addForm.header_background_image = '';
                fetchLists();
            });
        } else {
            console.log("error submit!", fields);
        }
    });
};

onMounted(() => {
    fetchLists();
});

</script>
<template>
    <div class="container">
        <el-form
            ref="ruleFormRef"
            :model="addForm"
            :rules="rules"
            label-width="120px"
            class="demo-ruleForm"
            status-icon
            label-position="top"
        >
            <el-form-item prop="name" label="Name" >
                <el-input v-model="addForm.name" autocomplete="off" />
            </el-form-item>
            <el-form-item prop="website" label="Website" >
                <el-input v-model="addForm.website" autocomplete="off" />
            </el-form-item>
            <el-form-item prop="facebook" label="Facebook" >
                <el-input v-model="addForm.facebook" autocomplete="off" />
            </el-form-item>
            <el-form-item prop="twitter" label="Twitter" >
                <el-input v-model="addForm.twitter" autocomplete="off" />
            </el-form-item>
            <el-form-item prop="instagram" label="Instagram" >
                <el-input v-model="addForm.instagram" autocomplete="off" />
            </el-form-item>
            <color-picker v-model="addForm.color"/>
            <el-form-item prop="header_background_image" label="Unsplash Search" >
                <el-input v-model="addForm.header_background_image" autocomplete="off" />
            </el-form-item>
            <el-form-item label="Logo" prop="logo">
                <Upload
                    :open="dialogFormVisible"
                    :modelValue="addForm.logo"
                    @update:modelValue="(newValue) => (addForm.logo = newValue)"
                />
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="submitForm(ruleFormRef)">
                    Save
                </el-button>
            </el-form-item>
        </el-form>
        <hr>
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
    </div>
</template>
