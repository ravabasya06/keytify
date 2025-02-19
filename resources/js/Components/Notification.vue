<template>
    <div v-if="$page.props.flash.message" class="alert">
        <font-awesome-icon icon="fa-solid fa-circle-info" />{{
            $page.props.flash.message
        }}
    </div>
</template>
<style scope>
.alert {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 10px;
    padding: 15px;
    margin: 15px;
    position: fixed;
    z-index: 4;
    width: max-content;
    border-radius: 10px;
    color: var(--color-text);
    background-color: var(--color-background-mute);
}
</style>
