<template>
    <v-dialog
        v-model="dialog"
        persistent
        width="50%"
    >
        <v-card>
                 I am Add book
        </v-card>
    </v-dialog>
    
</template>
<script>
    export default {
        data() {
            return {
                
            }
        },
        props : {
            dialog: {
                required: true,
                type: Boolean,
                default: false,
            }
        }
    }
</script>