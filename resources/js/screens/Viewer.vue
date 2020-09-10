<template>
    <div sticky-container class="sticky-container">
        <div class="container p-5">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>JSON Viewer</h1>
                </div>
            </div>

            <parseScreen v-if="viewMode === 'parse'" />
            <dataScreen v-if="viewMode === 'data'" />
        </div>
        <bottomNavigation />
    </div>
</template>

<script>

import ParseScreen from "./ParseScreen";
import BottomNavigation from "../components/BottomNavigation";
import DataScreen from "./DataScreen";

export default {
    name: "Viewer",
    data() {
        return {
            viewMode: 'parse'
        }
    },
    components: {
        parseScreen: ParseScreen,
        dataScreen: DataScreen,
        bottomNavigation: BottomNavigation
    }
}
</script>

<style scoped>
html, body, .sticky-container {
    height: 100vh;
    overflow: hidden;
}

.container {
    height: 100vh;
    overflow-y: auto;
}
</style>
