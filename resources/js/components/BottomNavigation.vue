<template>
    <div  v-sticky="true" sticky-side="bottom" sticky-z-index="1000">
        <div class="progressBar">
            <div class="content" :style="{width: getProgressWidth + '%'}"></div>
        </div>
        <div class="footer">
            <div class="row">
                <div class="col-sm-4">
                    <div class="status">
                        {{ currentIndex }} / {{ itemLength }}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="buttons text-center">
                        <button class="btn btn-outline-secondary" title="Zurück" @click="moveBackHandler">
                            <Zondicon icon="arrow-left" style="height: 24px;" />
                        </button>
                        <button class="btn btn-outline-secondary" title="Google Suche starten"  @click="goToGoogleHandler">
                            <Zondicon icon="search" style="height: 24px;" />
                        </button>
                        <button class="btn btn-outline-danger" title="Eintrag Löschen"  @click="deleteItemHandler">
                            <Zondicon icon="trash" style="height: 24px;" />
                        </button>
                        <button class="btn btn-outline-secondary" title="Speichern" @click="takeSnapshotHandler">
                            <Zondicon icon="save-disk" style="height: 24px;" />
                        </button>
                        <button class="btn btn-outline-secondary" title="Weiter" @click="moveOnHandler">
                            <Zondicon icon="arrow-right" style="height: 24px;" />
                        </button>
                    </div>

                </div>
                <div class="col-sm-4">
                    <div class="viewMode text-center">
                            <button class="btn btn-outline-secondary" title="Ansichtsmodus: Daten" @click="changeViewModeHandler('data')">
                                <Zondicon icon="edit-pencil" style="height: 24px;" />
                            </button>
                            <button class="btn btn-outline-secondary" title="Ansichtsmodus: Speicherstände" @click="changeViewModeHandler('snapshots')" >
                                <Zondicon icon="box" style="height: 24px;" />
                            </button>
                            <button class="btn btn-outline-secondary" style="margin-right: 20px;" title="Ansichtsmodus: Konfiguration" @click="changeViewModeHandler('config')" >
                                <Zondicon icon="cog" style="height: 24px;" />
                            </button>
                        <button class="btn btn-outline-secondary" style="margin-right: 20px;" title="Ansichtsmodus: Export" @click="changeViewModeHandler('export')" >
                            <Zondicon icon="file" style="height: 24px;" />
                        </button>
                    </div>
                </div>
            </div>


        </div>
    </div>

</template>

<script>
    import axios from 'axios';

    export default {
        name: "BottomNavigation",
        computed: {
            currentIndex() {
                if (this.$store.state.items.length === 0) {
                    return 0;
                }

                return this.$store.state.currentIndex + 1;
            },
            itemLength() {
                return this.$store.state.items.length;
            },
            getProgressWidth() {
                if (this.$store.state.items.length === 0) {
                    return 0;
                }

                let curIndex = this.$store.state.currentIndex + 1;

                let width = Math.ceil((curIndex / this.$store.state.items.length) * 100);

                return width;
            },
        },
        methods: {
            moveOnHandler() {
                if (this.currentIndex + 1 > this.itemLength) {
                    this.$store.dispatch('setViewMode', 'export');
                    return;
                }
                this.$store.dispatch('moveOn');
            },
            moveBackHandler() {
                if (this.currentIndex - 1 < 0) {
                    alert("Du kannst nicht weiter zurückgehen.");
                    return;
                }

                this.$store.dispatch('moveBack');
            },
            takeSnapshotHandler() {
                let snapshot = this.$store.getters.takeSnapshot;

                axios.post('api/snapshots/add', snapshot)
                    .then(response => {
                        alert("Der Stand wurde erfolgreich gespeichert.");
                    })
                    .catch(errors => {
                        alert(errors);
                    })
            },
            goToGoogleHandler() {
                let searchField = this.$store.state.searchField;

                window.open('https://maps.google.com?q=' + this.$store.state.currentItem[searchField], '_blank');
            },
            changeViewModeHandler(mode) {
                if (mode === 'data' && this.$store.state.items.length === 0) {
                    mode = 'parse';
                }
                this.$store.dispatch('setViewMode', mode);
            },
            deleteItemHandler() {
                let result = confirm("Möchtest du den Eintrag wirklich entfernen?");

               if (result) {
                   let items = this.$store.state.items;
                   let currentIndex = this.$store.state.currentIndex;
                   items.splice(currentIndex, 1)
                   this.$store.dispatch('setItems', items );
                   this.$store.dispatch('setCurrentItem',  items[currentIndex]);
               }
            }
        }
    }
</script>

<style scoped lang="scss">
    .footer {
        background-color: #fff;
        width: 100%;
        height: 60px;
    }

    .progressBar {
        width: 100%;
        height: 5px;

        .content {
            background-color: #ff0000;
            height: 5px;
        }
    }

    .status {
        width: 100%;
        height: 100%;
        text-align: center;
        padding: 20px;
        font-weight: bold;
    }

    .buttons, .viewMode {
        padding: 12px 0 0 0;
    }
</style>
