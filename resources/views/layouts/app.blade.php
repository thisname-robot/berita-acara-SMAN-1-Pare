<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Warta & Kabar Sekolah - SMAN 1 Pare')</title>

    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <style>
        @layer base {

            html,
            body {
                margin: 0;
                padding: 0;
            }

            body {
                overscroll-behavior: none;
            }

            main> :first-child {
                margin-top: 0 !important;
            }

            main> :last-child {
                margin-bottom: 0 !important;
            }
        }

        ::-webkit-scrollbar {
            display: none;
        }

        .no-scroll {
            overflow: hidden;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "secondary-fixed": "#d3e4fe",
                        surface: "#f7f9fb",
                        background: "#f7f9fb",
                        "primary-fixed-dim": "#bec6e0",
                        primary: "#000000",
                        "on-tertiary": "#ffffff",
                        "on-primary": "#ffffff",
                        "on-surface-variant": "#45464d",
                        "tertiary-fixed-dim": "#ffb77d",
                        "primary-fixed": "#dae2fd",
                        "surface-container-high": "#e6e8ea",
                        "on-secondary": "#ffffff",
                        "surface-container": "#eceef0",
                        "inverse-on-surface": "#eff1f3",
                        "surface-container-highest": "#e0e3e5",
                        "surface-dim": "#d8dadc",
                        "on-error-container": "#93000a",
                        tertiary: "#000000",
                        "outline-variant": "#c6c6cd",
                        "tertiary-fixed": "#ffdcc3",
                        "on-secondary-fixed": "#0b1c30",
                        "on-primary-container": "#7c839b",
                        "secondary-container": "#d0e1fb",
                        "surface-tint": "#565e74",
                        "on-background": "#191c1e",
                        "primary-container": "#131b2e",
                        error: "#ba1a1a",
                        "on-error": "#ffffff",
                        "secondary-fixed-dim": "#b7c8e1",
                        "inverse-surface": "#2d3133",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f2f4f6",
                        "inverse-primary": "#bec6e0",
                        "on-secondary-container": "#54647a",
                        "surface-bright": "#f7f9fb",
                        "error-container": "#ffdad6",
                        secondary: "#505f76",
                        "on-surface": "#191c1e",
                        "on-primary-fixed-variant": "#3f465c",
                        "on-tertiary-fixed-variant": "#6e3900",
                        "on-primary-fixed": "#131b2e",
                        "surface-variant": "#e0e3e5",
                        "on-tertiary-container": "#c76c00",
                        "on-tertiary-fixed": "#2f1500",
                        outline: "#76777d",
                        "on-secondary-fixed-variant": "#38485d",
                        "tertiary-container": "#2f1500",
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        full: "9999px"
                    },
                    spacing: {
                        "space-sm": "0.5rem",
                        "space-xl": "2.5rem",
                        "gutter-mobile": "1rem",
                        "space-lg": "1.5rem",
                        gutter: "1.5rem",
                        "space-xs": "0.25rem",
                        "margin-mobile": "1.25rem",
                        "space-md": "1rem",
                        margin: "3rem",
                    },
                    fontFamily: {
                        "body-sm": ["Inter"],
                        "label-sm": ["Inter"],
                        "display-hero": ["Plus Jakarta Sans"],
                        "headline-sm": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "code-inline": ["Inter"],
                        "label-md": ["Inter"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Inter"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "display-hero-mobile": ["Plus Jakarta Sans"],
                        "body-md": ["Inter"],
                        "title-md": ["Plus Jakarta Sans"],
                    },
                    fontSize: {
                        "body-sm": ["13px", {
                            lineHeight: "20px",
                            fontWeight: "400"
                        }],
                        "label-sm": ["12px", {
                            lineHeight: "16px",
                            letterSpacing: "0.04em",
                            fontWeight: "600"
                        }],
                        "display-hero": ["48px", {
                            lineHeight: "56px",
                            letterSpacing: "-0.03em",
                            fontWeight: "700"
                        }],
                        "headline-sm": ["20px", {
                            lineHeight: "28px",
                            letterSpacing: "-0.01em",
                            fontWeight: "600"
                        }],
                        "headline-lg": ["36px", {
                            lineHeight: "44px",
                            letterSpacing: "-0.025em",
                            fontWeight: "600"
                        }],
                        "code-inline": ["13px", {
                            lineHeight: "18px",
                            fontWeight: "500"
                        }],
                        "label-md": ["14px", {
                            lineHeight: "20px",
                            letterSpacing: "0.01em",
                            fontWeight: "500"
                        }],
                        "headline-md": ["24px", {
                            lineHeight: "32px",
                            letterSpacing: "-0.015em",
                            fontWeight: "600"
                        }],
                        "body-lg": ["18px", {
                            lineHeight: "28px",
                            fontWeight: "400"
                        }],
                        "headline-lg-mobile": ["26px", {
                            lineHeight: "34px",
                            letterSpacing: "-0.02em",
                            fontWeight: "600"
                        }],
                        "display-hero-mobile": ["32px", {
                            lineHeight: "40px",
                            letterSpacing: "-0.02em",
                            fontWeight: "700"
                        }],
                        "body-md": ["15px", {
                            lineHeight: "24px",
                            fontWeight: "400"
                        }],
                        "title-md": ["16px", {
                            lineHeight: "24px",
                            letterSpacing: "-0.005em",
                            fontWeight: "600"
                        }],
                    },
                },
            },
        };
    </script>
    @stack('styles')
</head>

<body class="bg-surface font-body-md text-body-md text-on-surface antialiased">
    @if ($showNavbar ?? true)
        @include('partials.navbar')
    @endif

    <main class="w-full pt-16 lg:pt-20 bg-surface min-h-[calc(100vh-64px)]">
        @yield('content')
    </main>

    @if($showFooter ?? true)
        @include('partials.footer')
    @endif
    @include('partials.scripts')
    @stack('scripts')
</body>

</html>
