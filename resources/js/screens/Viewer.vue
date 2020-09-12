<template>
    <div sticky-container class="sticky-container">
        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>JSON Viewer</h1>
                </div>
            </div>

            <parseScreen v-if="viewMode === 'parse'" />
            <dataScreen v-if="viewMode === 'data'" />
            <configScreen v-if="viewMode === 'config'" />
            <exportScreen v-if="viewMode === 'export'" />
            <snapshotScreen v-if="viewMode === 'snapshots'" />

        </div>
        <bottomNavigation  />
    </div>
</template>

<script>

import ParseScreen from "./ParseScreen";
import BottomNavigation from "../components/BottomNavigation";
import DataScreen from "./DataScreen";
import ConfigScreen from './ConfigScreen';
import ExportScreen from './ExportScreen';
import SnapshotScreen from './SnapshotScreen';

export default {
    name: "Viewer",
    computed: {
        viewMode() {
            console.log('viewMode', this.$store.state.viewMode);
            return this.$store.state.viewMode;
        }
    },
    components: {
        parseScreen: ParseScreen,
        dataScreen: DataScreen,
        bottomNavigation: BottomNavigation,
        configScreen: ConfigScreen,
        exportScreen: ExportScreen,
        snapshotScreen: SnapshotScreen
    }
}
</script>

<style scoped>
html, body, .sticky-container {
    height: 100vh;
    overflow: hidden;
}

.container-fluid {
    height: 100vh;
    overflow-y: auto;
}
</style>
