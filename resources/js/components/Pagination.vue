<template>
    <nav aria-label="Page navigation example" v-if="!client">
        <ul class="pagination pagination-sm justify-content-end">
            <li class="mx-4">
                <span class="">{{pagination.from}} - {{pagination.to}} de {{pagination.total}}</span>    
            </li>
            <li class="page-item">
                <a class="page-link" v-if="pagination.prevPageUrl" @click="$emit('prev');"><i class="fa fa-angle-left"></i></a>
                <a class="page-link" v-else :disabled="true"><i class="fa fa-angle-left"></i></a>
            </li>
            <li class="page-item">
                <a class="page-link" v-if="pagination.nextPageUrl" @click="$emit('next');"><i class="fa fa-angle-right"></i></a>
                <a class="page-link" v-else :disabled="true"><i class="fa fa-angle-right"></i></a>
            </li>
        </ul>
    </nav>

    <nav  v-else>
        <ul class="pagination">
            <span class="page-stats">{{pagination.from}} - {{pagination.to}} de {{pagination.total}}</span>
            <li class="page-item">
                <a class="page-link" v-if="pagination.prevPageUrl" @click="$emit('prev');">Previous</a>
                <a class="page-link" v-else :disabled="true">Previous</a>
            </li>
            <li class="page-item">
                <a class="page-link" v-if="pagination.nextPageUrl" @click="$emit('next');">next</a>
                <a class="page-link" v-else :disabled="true">next</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: ['pagination', 'client', 'filtered']
}
</script>