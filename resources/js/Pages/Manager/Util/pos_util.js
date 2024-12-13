import { provide, ref } from "vue";

const category = ref(1);

const selectCategory = (categoryId) => {
    category.value = categoryId;    
    
};


export {category,selectCategory}
