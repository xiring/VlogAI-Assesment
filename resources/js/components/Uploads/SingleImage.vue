<template>
    <el-upload
        ref="upload"
        :show-file-list="false"
        :data="additionalData"
        :action="`${url}api/files?uploadModule=${uploadModule}`"
        :headers="{ Authorization: token }"
        :multiple="false"
        :on-success="handleFileSuccess"
        class="upload-demo"
        drag
        :before-upload="beforeUpload"
    >
        <el-icon class="el-icon--upload">
            <upload-filled />
        </el-icon>
        <div class="el-upload__text">
            Drop file here or <em>click to upload</em>
        </div>
        <!-- <template #tip>
        </template> -->
    </el-upload>
    <div class="pl-12">
        <div v-show="imageUrl" class="image-preview-wrapper">
            <img :src="`${url}${imageUrl}`" style="width: 11rem" />
            <div class="image-preview-action">
                <i class="el-icon-delete" @click="rmImage" />
            </div>
        </div>
    </div>
</template>

<script>
import { UploadFilled } from "@element-plus/icons-vue";
import { mapState } from "pinia";
import { useMainStore } from "../../stores/mainStore";
import { ElMessage } from "element-plus";

export default {
    name: "SingleImageUpload1",
    components: { UploadFilled },
    props: {
        value: {
            type: String,
            default: "",
        },
        modelValue: {
            default: "",
        },
        open: {
            type: Boolean,
        },
        uploadModule: {
            default: "",
        },
    },
    emits: ["update:modelValue"],
    data() {
        return {
            imageUrl: "",
            tempUrl: "",
            additionalData: {},
            url: "http://127.0.0.1:8000/",
        };
    },
    watch: {
        open(newValue, oldValue) {
            this.$refs.upload.clearFiles();
            this.imageUrl = "";
        },
        value(newValue, oldValue) {
            this.$refs.upload.clearFiles();
            this.imageUrl = newValue;
        },
    },
    computed: {
        ...mapState(useMainStore, ["settings"]),
    },
    methods: {
        rmImage() {
            this.emitInput("");
        },
        emitInput(val) {
            this.$emit("input", val);
        },
        handleFileSuccess(file) {
            this.imageUrl = file.file;
            this.$emit("update:modelValue", file.file);
        },
    },
    mounted() {
        this.$refs.upload.clearFiles();
        this.imageUrl = this.value;
    },
};
</script>

<style scoped>
.upload-container {
    width: 100%;
}
</style>
