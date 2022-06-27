<template>
  <money3 v-model.number="modelValue" v-bind="config" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></money3>
</template>

<script>
  import { Money3Component } from 'v-money3'
  import config from '@/config/money';

  export default {
    components: { money3: Money3Component },
    props: ['modelValue'],
    emits: ['update:modelValue'],
    data () {
      return {
        config
      }
    },
    watch: {
      modelValue() {
        this.$emit('update:modelValue', this.modelValue);
      }
    }
  }
</script>
