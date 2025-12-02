<script setup lang="ts">
import { dashboard, login, register } from '@/routes';
import { Head, Link } from '@inertiajs/vue3';

withDefaults(
  defineProps<{
        canRegister: boolean;
    }>(),
  {
    canRegister : true,
  },
);
</script>

<template>
    <Head title="Welcome" />

    <div class="bg-body text-body min-vh-100">
        <div class="container py-5">
            <header class="d-flex justify-content-end gap-3 mb-5">
                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class="btn btn-outline-secondary"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link :href="login()" class="btn btn-link text-decoration-none">
                        Log in
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="register()"
                        class="btn btn-outline-secondary"
                    >
                        Register
                    </Link>
                </template>
            </header>

            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h1 class="display-5 fw-semibold mb-3">Let's get started</h1>
                    <p class="text-muted mb-4">
                        Laravel has an incredibly rich ecosystem. We suggest starting with the following resources to accelerate your onboarding.
                    </p>
                    <ul class="list-unstyled mb-4">
                        <li class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary-subtle text-primary-emphasis me-3">1</span>
                            <a href="https://laravel.com/docs" target="_blank" class="text-decoration-none fw-semibold">
                                Read the Documentation
                            </a>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary-subtle text-primary-emphasis me-3">2</span>
                            <a href="https://laracasts.com" target="_blank" class="text-decoration-none fw-semibold">
                                Watch tutorials on Laracasts
                            </a>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary-subtle text-primary-emphasis me-3">3</span>
                            <a href="https://laravel-news.com" target="_blank" class="text-decoration-none fw-semibold">
                                Stay up to date with Laravel News
                            </a>
                        </li>
                    </ul>
                    <div class="d-flex gap-3">
                        <a
                            href="https://cloud.laravel.com"
                            target="_blank"
                            class="btn btn-primary"
                        >
                            Deploy now
                        </a>
                        <a
                            href="https://laravel-news.com"
                            target="_blank"
                            class="btn btn-outline-secondary"
                        >
                            Read Laravel News
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="bg-primary-subtle rounded-4 p-4 shadow-sm">
                        <svg
                            width="320"
                            height="160"
                            viewBox="0 0 320 160"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M59 10H40V150H90V125H59V10Z"
                                fill="currentColor"
                            />
                            <path
                                d="M140 60C136 53 130 48 122 44C114 40 106 38 98 38C89 38 80 40 72 44C64 48 57 53 52 60C46 67 42 74 40 84C38 93 38 103 40 112C42 121 46 129 52 136C57 143 64 148 72 152C80 156 89 158 98 158C106 158 114 156 122 152C130 148 136 143 140 136V150H160V40H140V60ZM137 120C135 126 132 131 128 135C124 139 119 142 114 144C109 146 104 147 98 147C93 147 87 146 82 144C77 142 72 139 68 135C64 131 61 126 59 120C57 114 56 108 56 101C56 95 57 89 59 83C61 77 64 72 68 68C72 63 77 60 82 58C87 56 93 55 98 55C104 55 109 56 114 58C119 60 124 63 128 68C132 72 135 77 137 83C139 89 140 95 140 101C140 108 139 114 137 120Z"
                                fill="currentColor"
                            />
                            <path
                                d="M260 60C256 53 250 48 242 44C234 40 226 38 218 38C209 38 200 40 192 44C184 48 177 53 172 60C166 67 162 74 160 84C158 93 158 103 160 112C162 121 166 129 172 136C177 143 184 148 192 152C200 156 209 158 218 158C226 158 234 156 242 152C250 148 256 143 260 136V150H280V40H260V60ZM257 120C255 126 252 131 248 135C244 139 239 142 234 144C229 146 224 147 218 147C213 147 207 146 202 144C197 142 192 139 188 135C184 131 181 126 179 120C177 114 176 108 176 101C176 95 177 89 179 83C181 77 184 72 188 68C192 63 197 60 202 58C207 56 213 55 218 55C224 55 229 56 234 58C239 60 244 63 248 68C252 72 255 77 257 83C259 89 260 95 260 101C260 108 259 114 257 120Z"
                                fill="currentColor"
                            />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
