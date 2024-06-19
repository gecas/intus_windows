<template v-slot:layout>
   <div>
       <form class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
           <div class="px-4 py-6 sm:p-8">
               <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                   <div class="sm:col-span-4">
                       <label for="website" class="block text-sm font-medium leading-6 text-gray-900">Enter URL you want to shorten:</label>
                       <div class="mt-2">
                           <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                               <input type="text" v-model="url" name="website" id="website"
                                      class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                      placeholder="http://www.example.com">
                           </div>
                       </div>
                   </div>
               </div>
               <div class="rounded-md bg-red-50 p-4 mt-8" v-if="shouldShowErrors">
                   <div class="ml-auto pl-3 flex w-full justify-end">
                       <div class="-mx-1.5 -my-1.5">
                           <button type="button" @click="errors = []" class="inline-flex rounded-md bg-red-50 p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
                               <span class="sr-only">Dismiss</span>
                               <XMarkIcon class="h-5 w-5" aria-hidden="true" />
                           </button>
                       </div>
                   </div>
                   <div class="flex flex-col m-2">
                       <div class="flex" v-for="error in errors">
                           <div class="flex-shrink-0">
                               <CheckCircleIcon class="h-5 w-5 text-red-400" aria-hidden="true" />
                           </div>
                           <div class="ml-3">
                               <p class="text-sm font-medium text-red-800">{{ error }}</p>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <div class="w-full flex item-center justify-end border-t border-gray-900/10">
               <div v-if="shortenUrl" class="items-center w-full pt-6">
                   <span class="pl-4">Generated shorten url:</span>
                   <a class="pl-2 text-indigo-800 font-bold" :href="shortenUrl" target="_blank">{{ shortenUrl }}</a>
               </div>
               <div class="flex items-center justify-end gap-x-6 px-4 py-4 sm:px-8">
                   <button @click="submitUrl" type="button" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                   <button type="button" @click="cancel" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
               </div>
           </div>
       </form>
   </div>
</template>
<script setup lang="ts">
import {ref, computed} from "vue";
import UrlShortenService from "../Services/UrlShortenService"
import { CheckCircleIcon, XMarkIcon } from '@heroicons/vue/20/solid'

let url = ref('')
let shortenUrl = ref('')
let errors = ref([])

function submitUrl()
{
    errors.value = []
    UrlShortenService.shortenUrl(url.value).then((response) => {
        shortenUrl.value = response.data.data.shorten_url
    }).catch((response) => {
        let status = response.response.status
        let responseErrors = response.response.data.errors
        switch(status) {
            case 422:
                Object.values(responseErrors).map((error) => errors.value.push(error[0]))
                break;
            case 500:
                errors.value.push('Something went wrong, try again later')
                break;
            case 400:
                errors.value.push('Bad request, try again later')
                break;
        }
    })
}

function cancel(){
    url.value = ''
    shortenUrl.value = ''
}

const shouldShowErrors = computed(() => {
    return errors.value.length > 0
})
</script>
