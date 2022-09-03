<template>
    <div>
        <v-card
        max-height="80%"
        min-height="80%"
        v-if="$is_admin()"
        >
            <Subject />
        </v-card>
        <v-card
        elevation="0"
        v-else>
            <v-spacer></v-spacer>
            <v-img
                style="width: 90%; height: 50%;"
                :src="error"
            ></v-img>
            <v-spacer></v-spacer>
        </v-card>
        
    </div>
</template>
<script>
    import Subject from './includes/subject.vue'
    export default {
        components : {
            Subject
        }
    }
</script>