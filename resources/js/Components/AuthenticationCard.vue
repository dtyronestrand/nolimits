<template>
    <div
        class="register min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0"
    >
        <div>
            <slot name="logo" />
        </div>

        <div class="main-form">
            <slot />
        </div>
    </div>
</template>

<style scoped>
.main-form {
    background-color: rgba(from var(--color-primary-800) R G B / 0.7);
    backdrop-filter: blur(10px);
    color: var(--color-neutral-100);
    border: 2px solid var(--color-tertiary-500);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 0.5rem; /* Adjusted for a more modern look */
    padding: 1.5rem; /* Added padding for better spacing */
    width: 100%;
    max-width: 400px; /* Set a maximum width for the form */
    margin-top: 2rem; /* Added margin-top for spacing */
}
</style>
