<template>
    <div  v-sticky="true" sticky-side="bottom" sticky-z-index="1000">
        <div class="progressBar">
            <div class="content"></div>
        </div>
        <div class="footer">
            <div class="row">
                <div class="col-sm-4">
                    <div class="status">
                        1 / 13
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="buttons text-center">
                        <button class="btn btn-outline-secondary" title="Zu Google Maps">
                            <Zondicon icon="map" style="height: 24px;" />
                        </button>
                        <button class="btn btn-outline-secondary" title="Speichern">
                            <Zondicon icon="save-disk" style="height: 24px;" />
                        </button>
                        <button class="btn btn-outline-secondary" title="Exportieren">
                            <Zondicon icon="download" style="height: 24px;" />
                        </button>
                        <button class="btn btn-outline-secondary" title="Hinzufügen">
                            <Zondicon icon="add-outline" style="height: 24px;" />
                        </button>
                        <button class="btn btn-outline-secondary" title="Weiter">
                            <Zondicon icon="arrow-right" style="height: 24px;" />
                        </button>
                    </div>

                </div>
                <div class="col-sm-4">
                    <div class="viewMode text-center">
                            <button class="btn btn-outline-secondary" title="Ansichtsmodus: Daten">
                                <Zondicon icon="compose" style="height: 24px;" />
                            </button>
                            <button class="btn btn-outline-secondary" style="margin-right: 20px;" title="Ansichtsmodus: Speicherstände" >
                                <Zondicon icon="queue" style="height: 24px;" />
                            </button>
                    </div>
                </div>
            </div>


        </div>
    </div>

</template>

<script>
export default {
name: "BottomNavigation",
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
            width: 1%;
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
        justify-content: 'space-around';
    }
</style>
