import { definePreset } from '@primevue/themes';
        import Aura from '@primevue/themes/aura';

        const MyPreset = definePreset(Aura, {
            primitive: {
                borderRadius: {
                    none: "0",
                    xs: "8px",
                    sm: "10px",
                    md: "12px",
                    lg: "18px",
                    xl: "26px"
                },
                emerald: {
                    50: "#f3fbf9",
                    100: "#c6eee2",
                    200: "#98e0cb",
                    300: "#6bd2b3",
                    400: "#3dc59c",
                    500: "#10b785",
                    600: "#0e9c71",
                    700: "#0b805d",
                    800: "#096549",
                    900: "#064935",
                    950: "#042e21"
                },
                green: {
                    50: "#f0fdf4",
                    100: "#dcfce7",
                    200: "#bbf7d0",
                    300: "#86efac",
                    400: "#4ade80",
                    500: "#22c55e",
                    600: "#16a34a",
                    700: "#15803d",
                    800: "#166534",
                    900: "#14532d",
                    950: "#052e16"
                },
                lime: {
                    50: "#f7fee7",
                    100: "#ecfccb",
                    200: "#d9f99d",
                    300: "#bef264",
                    400: "#a3e635",
                    500: "#84cc16",
                    600: "#65a30d",
                    700: "#4d7c0f",
                    800: "#3f6212",
                    900: "#365314",
                    950: "#1a2e05"
                },
                red: {
                    50: "#fff4f4",
                    100: "#ffcaca",
                    200: "#ffa1a1",
                    300: "#ff7777",
                    400: "#ff4e4e",
                    500: "#ff2424",
                    600: "#d91f1f",
                    700: "#b31919",
                    800: "#8c1414",
                    900: "#660e0e",
                    950: "#400909"
                },
                orange: {
                    50: "#fff9f3",
                    100: "#ffe4c5",
                    200: "#fece97",
                    300: "#feb869",
                    400: "#fda33b",
                    500: "#fd8d0d",
                    600: "#d7780b",
                    700: "#b16309",
                    800: "#8b4e07",
                    900: "#653805",
                    950: "#3f2303"
                },
                amber: {
                    50: "#fffbeb",
                    100: "#fef3c7",
                    200: "#fde68a",
                    300: "#fcd34d",
                    400: "#fbbf24",
                    500: "#f59e0b",
                    600: "#d97706",
                    700: "#b45309",
                    800: "#92400e",
                    900: "#78350f",
                    950: "#451a03"
                },
                yellow: {
                    50: "#fefce8",
                    100: "#fef9c3",
                    200: "#fef08a",
                    300: "#fde047",
                    400: "#facc15",
                    500: "#eab308",
                    600: "#ca8a04",
                    700: "#a16207",
                    800: "#854d0e",
                    900: "#713f12",
                    950: "#422006"
                },
                teal: {
                    50: "#f0fdfa",
                    100: "#ccfbf1",
                    200: "#99f6e4",
                    300: "#5eead4",
                    400: "#2dd4bf",
                    500: "#14b8a6",
                    600: "#0d9488",
                    700: "#0f766e",
                    800: "#115e59",
                    900: "#134e4a",
                    950: "#042f2e"
                },
                cyan: {
                    50: "#ecfeff",
                    100: "#cffafe",
                    200: "#a5f3fc",
                    300: "#67e8f9",
                    400: "#22d3ee",
                    500: "#06b6d4",
                    600: "#0891b2",
                    700: "#0e7490",
                    800: "#155e75",
                    900: "#164e63",
                    950: "#083344"
                },
                sky: {
                    50: "#f0f9ff",
                    100: "#e0f2fe",
                    200: "#bae6fd",
                    300: "#7dd3fc",
                    400: "#38bdf8",
                    500: "#0ea5e9",
                    600: "#0284c7",
                    700: "#0369a1",
                    800: "#075985",
                    900: "#0c4a6e",
                    950: "#082f49"
                },
                blue: {
                    50: "#eff6ff",
                    100: "#dbeafe",
                    200: "#bfdbfe",
                    300: "#93c5fd",
                    400: "#60a5fa",
                    500: "#3b82f6",
                    600: "#2563eb",
                    700: "#1d4ed8",
                    800: "#1e40af",
                    900: "#1e3a8a",
                    950: "#172554"
                },
                indigo: {
                    50: "#eef2ff",
                    100: "#e0e7ff",
                    200: "#c7d2fe",
                    300: "#a5b4fc",
                    400: "#818cf8",
                    500: "#6366f1",
                    600: "#4f46e5",
                    700: "#4338ca",
                    800: "#3730a3",
                    900: "#312e81",
                    950: "#1e1b4b"
                },
                violet: {
                    50: "#f5f3ff",
                    100: "#ede9fe",
                    200: "#ddd6fe",
                    300: "#c4b5fd",
                    400: "#a78bfa",
                    500: "#8b5cf6",
                    600: "#7c3aed",
                    700: "#6d28d9",
                    800: "#5b21b6",
                    900: "#4c1d95",
                    950: "#2e1065"
                },
                purple: {
                    50: "#faf5ff",
                    100: "#f3e8ff",
                    200: "#e9d5ff",
                    300: "#d8b4fe",
                    400: "#c084fc",
                    500: "#a855f7",
                    600: "#9333ea",
                    700: "#7e22ce",
                    800: "#6b21a8",
                    900: "#581c87",
                    950: "#3b0764"
                },
                fuchsia: {
                    50: "#fdf4ff",
                    100: "#fae8ff",
                    200: "#f5d0fe",
                    300: "#f0abfc",
                    400: "#e879f9",
                    500: "#d946ef",
                    600: "#c026d3",
                    700: "#a21caf",
                    800: "#86198f",
                    900: "#701a75",
                    950: "#4a044e"
                },
                pink: {
                    50: "#fdf2f8",
                    100: "#fce7f3",
                    200: "#fbcfe8",
                    300: "#f9a8d4",
                    400: "#f472b6",
                    500: "#ec4899",
                    600: "#db2777",
                    700: "#be185d",
                    800: "#9d174d",
                    900: "#831843",
                    950: "#500724"
                },
                rose: {
                    50: "#fff4fa",
                    100: "#ffc8e8",
                    200: "#ff9dd6",
                    300: "#ff71c3",
                    400: "#ff46b1",
                    500: "#ff1a9f",
                    600: "#d91687",
                    700: "#b3126f",
                    800: "#8c0e57",
                    900: "#660a40",
                    950: "#400728"
                },
                slate: {
                    50: "#f8fafc",
                    100: "#f1f5f9",
                    200: "#e2e8f0",
                    300: "#cbd5e1",
                    400: "#94a3b8",
                    500: "#64748b",
                    600: "#475569",
                    700: "#334155",
                    800: "#1e293b",
                    900: "#0f172a",
                    950: "#020617"
                },
                gray: {
                    50: "#f9fafb",
                    100: "#f3f4f6",
                    200: "#e5e7eb",
                    300: "#d1d5db",
                    400: "#9ca3af",
                    500: "#6b7280",
                    600: "#4b5563",
                    700: "#374151",
                    800: "#1f2937",
                    900: "#111827",
                    950: "#030712"
                },
                zinc: {
                    50: "#fafafa",
                    100: "#f4f4f5",
                    200: "#e4e4e7",
                    300: "#d4d4d8",
                    400: "#a1a1aa",
                    500: "#71717a",
                    600: "#52525b",
                    700: "#3f3f46",
                    800: "#27272a",
                    900: "#18181b",
                    950: "#09090b"
                },
                neutral: {
                    50: "#fafafa",
                    100: "#f5f5f5",
                    200: "#e5e5e5",
                    300: "#d4d4d4",
                    400: "#a3a3a3",
                    500: "#737373",
                    600: "#525252",
                    700: "#404040",
                    800: "#262626",
                    900: "#171717",
                    950: "#0a0a0a"
                },
                stone: {
                    50: "#fafaf9",
                    100: "#f5f5f4",
                    200: "#e7e5e4",
                    300: "#d6d3d1",
                    400: "#a8a29e",
                    500: "#78716c",
                    600: "#57534e",
                    700: "#44403c",
                    800: "#292524",
                    900: "#1c1917",
                    950: "#0c0a09"
                }
            },
            semantic: {
                transitionDuration: "0.3s",
                focusRing: {
                    width: "none",
                    style: "solid",
                    color: "{primary.color}",
                    offset: "2px",
                    shadow: "none"
                },
                disabledOpacity: "0.7",
                iconSize: "1rem",
                anchorGutter: "2px",
                primary: {
                    50: "#f5f5ff",
                    100: "#cfceff",
                    200: "#a9a7ff",
                    300: "#8281ff",
                    400: "#5c5aff",
                    500: "#3633ff",
                    600: "#2e2bd9",
                    700: "#2624b3",
                    800: "#1e1c8c",
                    900: "#161466",
                    950: "#0e0d40"
                },
                formField: {
                    paddingX: "0.75rem",
                    paddingY: "0.5rem",
                    sm: {
                        fontSize: "0.875rem",
                        paddingX: "0.625rem",
                        paddingY: "0.375rem"
                    },
                    lg: {
                        fontSize: "1.125rem",
                        paddingX: "0.875rem",
                        paddingY: "0.625rem"
                    },
                    borderRadius: "{border.radius.md}",
                    focusRing: {
                        width: "0",
                        style: "none",
                        color: "transparent",
                        offset: "0",
                        shadow: "none"
                    },
                    transitionDuration: "{transition.duration}"
                },
                list: {
                    padding: "0.25rem 0.25rem",
                    gap: "2px",
                    header: {
                        padding: "0.5rem 1rem 0.25rem 1rem"
                    },
                    option: {
                        padding: "0.5rem 0.75rem",
                        borderRadius: "{border.radius.sm}"
                    },
                    optionGroup: {
                        padding: "0.5rem 0.75rem",
                        fontWeight: "600"
                    }
                },
                content: {
                    borderRadius: "{border.radius.md}"
                },
                mask: {
                    transitionDuration: "0.17s"
                },
                navigation: {
                    list: {
                        padding: "0.25rem 0.25rem",
                        gap: "2px"
                    },
                    item: {
                        padding: "0.5rem 0.75rem",
                        borderRadius: "{border.radius.sm}",
                        gap: "0.5rem"
                    },
                    submenuLabel: {
                        padding: "0.5rem 0.75rem",
                        fontWeight: "600"
                    },
                    submenuIcon: {
                        size: "0.875rem"
                    }
                },
                overlay: {
                    select: {
                        borderRadius: "{border.radius.md}",
                        shadow: "0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1)"
                    },
                    popover: {
                        borderRadius: "{border.radius.md}",
                        padding: "0.75rem",
                        shadow: "0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1)"
                    },
                    modal: {
                        borderRadius: "{border.radius.xl}",
                        padding: "1.25rem",
                        shadow: "0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1)"
                    },
                    navigation: {
                        shadow: "0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1)"
                    }
                },
                colorScheme: {
                    light: {
                        surface: {
                            0: "#ffffff",
                            50: "#fafafe",
                            100: "#e8e5f8",
                            200: "#d6d0f3",
                            300: "#c4bbed",
                            400: "#b2a7e8",
                            500: "#a092e2",
                            600: "#887cc0",
                            700: "#70669e",
                            800: "#58507c",
                            900: "#403a5a",
                            950: "#000000"
                        },
                        primary: {
                            color: "{primary.0}",
                            contrastColor: "surface.0",
                            hoverColor: "{primary.600}",
                            activeColor: "{primary.700}"
                        },
                        highlight: {
                            background: "{primary.50}",
                            focusBackground: "{primary.100}",
                            color: "{primary.700}",
                            focusColor: "{primary.800}"
                        },
                        mask: {
                            background: "rgba(0,0,0,0.4)",
                            color: "{surface.200}"
                        },
                        formField: {
                            background: "{surface.0}",
                            disabledBackground: "{surface.200}",
                            filledBackground: "{surface.50}",
                            filledHoverBackground: "{surface.50}",
                            filledFocusBackground: "{surface.50}",
                            borderColor: "{surface.300}",
                            hoverBorderColor: "{surface.400}",
                            focusBorderColor: "{primary.color}",
                            invalidBorderColor: "{red.400}",
                            color: "{surface.700}",
                            disabledColor: "{surface.500}",
                            placeholderColor: "{surface.500}",
                            invalidPlaceholderColor: "{red.600}",
                            floatLabelColor: "{surface.500}",
                            floatLabelFocusColor: "{primary.600}",
                            floatLabelActiveColor: "{surface.500}",
                            floatLabelInvalidColor: "{form.field.invalid.placeholder.color}",
                            iconColor: "{surface.400}",
                            shadow: "0 0 #0000, 0 0 #0000, 0 1px 2px 0 rgba(18, 18, 23, 0.05)"
                        },
                        text: {
                            color: "{surface.950}",
                            hoverColor: "{surface.800}",
                            mutedColor: "{surface.500}",
                            hoverMutedColor: "{surface.600}"
                        },
                        content: {
                            background: "{surface.0}",
                            hoverBackground: "{surface.100}",
                            borderColor: "{surface.200}",
                            color: "{text.color}",
                            hoverColor: "{text.hover.color}"
                        },
                        overlay: {
                            select: {
                                background: "{surface.0}",
                                borderColor: "{surface.200}",
                                color: "{text.color}"
                            },
                            popover: {
                                background: "{surface.0}",
                                borderColor: "{surface.200}",
                                color: "{text.color}"
                            },
                            modal: {
                                background: "{surface.0}",
                                borderColor: "{surface.200}",
                                color: "{text.color}"
                            }
                        },
                        list: {
                            option: {
                                focusBackground: "{surface.100}",
                                selectedBackground: "{highlight.background}",
                                selectedFocusBackground: "{highlight.focus.background}",
                                color: "{text.color}",
                                focusColor: "{text.hover.color}",
                                selectedColor: "{highlight.color}",
                                selectedFocusColor: "{highlight.focus.color}",
                                icon: {
                                    color: "{surface.400}",
                                    focusColor: "{surface.500}"
                                }
                            },
                            optionGroup: {
                                background: "transparent",
                                color: "{text.muted.color}"
                            }
                        },
                        navigation: {
                            item: {
                                focusBackground: "{surface.100}",
                                activeBackground: "{surface.100}",
                                color: "{text.color}",
                                focusColor: "{text.hover.color}",
                                activeColor: "{text.hover.color}",
                                icon: {
                                    color: "{surface.400}",
                                    focusColor: "{surface.500}",
                                    activeColor: "{surface.500}"
                                }
                            },
                            submenuLabel: {
                                background: "transparent",
                                color: "{text.muted.color}"
                            },
                            submenuIcon: {
                                color: "{surface.400}",
                                focusColor: "{surface.500}",
                                activeColor: "{surface.500}"
                            }
                        }
                    },
                    dark: {
                        surface: {
                            0: "#ffffff",
                            50: "#f5f5f6",
                            100: "#cfcfd4",
                            200: "#aaa9b2",
                            300: "#848491",
                            400: "#5f5e6f",
                            500: "#39384d",
                            600: "#303041",
                            700: "#282736",
                            800: "#1f1f2a",
                            900: "#17161f",
                            950: "#000000"
                        },
                        primary: {
                            color: "{primary.0}",
                            contrastColor: "{surface.950}",
                            hoverColor: "{primary.300}",
                            activeColor: "{primary.200}"
                        },
                        highlight: {
                            background: "color-mix(in srgb, {primary.400}, transparent 84%)",
                            focusBackground: "color-mix(in srgb, {primary.400}, transparent 76%)",
                            color: "rgba(255,255,255,.87)",
                            focusColor: "rgba(255,255,255,.87)"
                        },
                        mask: {
                            background: "rgba(0,0,0,0.6)",
                            color: "{surface.200}"
                        },
                        formField: {
                            background: "{surface.950}",
                            disabledBackground: "{surface.700}",
                            filledBackground: "{surface.800}",
                            filledHoverBackground: "{surface.800}",
                            filledFocusBackground: "{surface.800}",
                            borderColor: "{surface.600}",
                            hoverBorderColor: "{surface.500}",
                            focusBorderColor: "{primary.color}",
                            invalidBorderColor: "{red.300}",
                            color: "{surface.0}",
                            disabledColor: "{surface.400}",
                            placeholderColor: "{surface.400}",
                            invalidPlaceholderColor: "{red.400}",
                            floatLabelColor: "{surface.400}",
                            floatLabelFocusColor: "{primary.color}",
                            floatLabelActiveColor: "{surface.400}",
                            floatLabelInvalidColor: "{form.field.invalid.placeholder.color}",
                            iconColor: "{surface.400}",
                            shadow: "0 0 #0000, 0 0 #0000, 0 1px 2px 0 rgba(18, 18, 23, 0.05)"
                        },
                        text: {
                            color: "{surface.0}",
                            hoverColor: "{surface.0}",
                            mutedColor: "{surface.400}",
                            hoverMutedColor: "{surface.300}"
                        },
                        content: {
                            background: "{surface.900}",
                            hoverBackground: "{surface.800}",
                            borderColor: "{surface.700}",
                            color: "{text.color}",
                            hoverColor: "{text.hover.color}"
                        },
                        overlay: {
                            select: {
                                background: "{surface.900}",
                                borderColor: "{surface.700}",
                                color: "{text.color}"
                            },
                            popover: {
                                background: "{surface.900}",
                                borderColor: "{surface.700}",
                                color: "{text.color}"
                            },
                            modal: {
                                background: "{surface.900}",
                                borderColor: "{surface.700}",
                                color: "{text.color}"
                            }
                        },
                        list: {
                            option: {
                                focusBackground: "{surface.800}",
                                selectedBackground: "{highlight.background}",
                                selectedFocusBackground: "{highlight.focus.background}",
                                color: "{text.color}",
                                focusColor: "{text.hover.color}",
                                selectedColor: "{highlight.color}",
                                selectedFocusColor: "{highlight.focus.color}",
                                icon: {
                                    color: "{surface.500}",
                                    focusColor: "{surface.400}"
                                }
                            },
                            optionGroup: {
                                background: "transparent",
                                color: "{text.muted.color}"
                            }
                        },
                        navigation: {
                            item: {
                                focusBackground: "{surface.800}",
                                activeBackground: "{surface.800}",
                                color: "{text.color}",
                                focusColor: "{text.hover.color}",
                                activeColor: "{text.hover.color}",
                                icon: {
                                    color: "{surface.500}",
                                    focusColor: "{surface.400}",
                                    activeColor: "{surface.400}"
                                }
                            },
                            submenuLabel: {
                                background: "transparent",
                                color: "{text.muted.color}"
                            },
                            submenuIcon: {
                                color: "{surface.500}",
                                focusColor: "{surface.400}",
                                activeColor: "{surface.400}"
                            }
                        }
                    }
                }
            }
        });

        const Noir = definePreset(Aura, {
            primitive: {
                borderRadius: {
                    none: "1px",
                    xs: "7px",
                    sm: "9px",
                    md: "11px",
                    lg: "17px",
                    xl: "21px"
                },
                emerald: {
                    50: "#f3fbf9",
                    100: "#c6eee2",
                    200: "#98e0cb",
                    300: "#6bd2b3",
                    400: "#3dc59c",
                    500: "#10b785",
                    600: "#0e9c71",
                    700: "#0b805d",
                    800: "#096549",
                    900: "#064935",
                    950: "#042e21"
                },
                green: {
                    50: "#f0fdf4",
                    100: "#dcfce7",
                    200: "#bbf7d0",
                    300: "#86efac",
                    400: "#4ade80",
                    500: "#22c55e",
                    600: "#16a34a",
                    700: "#15803d",
                    800: "#166534",
                    900: "#14532d",
                    950: "#052e16"
                },
                lime: {
                    50: "#f7fee7",
                    100: "#ecfccb",
                    200: "#d9f99d",
                    300: "#bef264",
                    400: "#a3e635",
                    500: "#84cc16",
                    600: "#65a30d",
                    700: "#4d7c0f",
                    800: "#3f6212",
                    900: "#365314",
                    950: "#1a2e05"
                },
                red: {
                    50: "#fff4f4",
                    100: "#ffcaca",
                    200: "#ffa1a1",
                    300: "#ff7777",
                    400: "#ff4e4e",
                    500: "#ff2424",
                    600: "#d91f1f",
                    700: "#b31919",
                    800: "#8c1414",
                    900: "#660e0e",
                    950: "#400909"
                },
                orange: {
                    50: "#fff9f3",
                    100: "#ffe4c5",
                    200: "#fece97",
                    300: "#feb869",
                    400: "#fda33b",
                    500: "#fd8d0d",
                    600: "#d7780b",
                    700: "#b16309",
                    800: "#8b4e07",
                    900: "#653805",
                    950: "#3f2303"
                },
                amber: {
                    50: "#fffbeb",
                    100: "#fef3c7",
                    200: "#fde68a",
                    300: "#fcd34d",
                    400: "#fbbf24",
                    500: "#f59e0b",
                    600: "#d97706",
                    700: "#b45309",
                    800: "#92400e",
                    900: "#78350f",
                    950: "#451a03"
                },
                yellow: {
                    50: "#fefce8",
                    100: "#fef9c3",
                    200: "#fef08a",
                    300: "#fde047",
                    400: "#facc15",
                    500: "#eab308",
                    600: "#ca8a04",
                    700: "#a16207",
                    800: "#854d0e",
                    900: "#713f12",
                    950: "#422006"
                },
                teal: {
                    50: "#f0fdfa",
                    100: "#ccfbf1",
                    200: "#99f6e4",
                    300: "#5eead4",
                    400: "#2dd4bf",
                    500: "#14b8a6",
                    600: "#0d9488",
                    700: "#0f766e",
                    800: "#115e59",
                    900: "#134e4a",
                    950: "#042f2e"
                },
                cyan: {
                    50: "#ecfeff",
                    100: "#cffafe",
                    200: "#a5f3fc",
                    300: "#67e8f9",
                    400: "#22d3ee",
                    500: "#06b6d4",
                    600: "#0891b2",
                    700: "#0e7490",
                    800: "#155e75",
                    900: "#164e63",
                    950: "#083344"
                },
                sky: {
                    50: "#f0f9ff",
                    100: "#e0f2fe",
                    200: "#bae6fd",
                    300: "#7dd3fc",
                    400: "#38bdf8",
                    500: "#0ea5e9",
                    600: "#0284c7",
                    700: "#0369a1",
                    800: "#075985",
                    900: "#0c4a6e",
                    950: "#082f49"
                },
                blue: {
                    50: "#eff6ff",
                    100: "#dbeafe",
                    200: "#bfdbfe",
                    300: "#93c5fd",
                    400: "#60a5fa",
                    500: "#3b82f6",
                    600: "#2563eb",
                    700: "#1d4ed8",
                    800: "#1e40af",
                    900: "#1e3a8a",
                    950: "#172554"
                },
                indigo: {
                    50: "#eef2ff",
                    100: "#e0e7ff",
                    200: "#c7d2fe",
                    300: "#a5b4fc",
                    400: "#818cf8",
                    500: "#6366f1",
                    600: "#4f46e5",
                    700: "#4338ca",
                    800: "#3730a3",
                    900: "#312e81",
                    950: "#1e1b4b"
                },
                violet: {
                    50: "#f5f3ff",
                    100: "#ede9fe",
                    200: "#ddd6fe",
                    300: "#c4b5fd",
                    400: "#a78bfa",
                    500: "#8b5cf6",
                    600: "#7c3aed",
                    700: "#6d28d9",
                    800: "#5b21b6",
                    900: "#4c1d95",
                    950: "#2e1065"
                },
                purple: {
                    50: "#faf5ff",
                    100: "#f3e8ff",
                    200: "#e9d5ff",
                    300: "#d8b4fe",
                    400: "#c084fc",
                    500: "#a855f7",
                    600: "#9333ea",
                    700: "#7e22ce",
                    800: "#6b21a8",
                    900: "#581c87",
                    950: "#3b0764"
                },
                fuchsia: {
                    50: "#fdf4ff",
                    100: "#fae8ff",
                    200: "#f5d0fe",
                    300: "#f0abfc",
                    400: "#e879f9",
                    500: "#d946ef",
                    600: "#c026d3",
                    700: "#a21caf",
                    800: "#86198f",
                    900: "#701a75",
                    950: "#4a044e"
                },
                pink: {
                    50: "#fdf2f8",
                    100: "#fce7f3",
                    200: "#fbcfe8",
                    300: "#f9a8d4",
                    400: "#f472b6",
                    500: "#ec4899",
                    600: "#db2777",
                    700: "#be185d",
                    800: "#9d174d",
                    900: "#831843",
                    950: "#500724"
                },
                rose: {
                    50: "#fff4fa",
                    100: "#ffc8e8",
                    200: "#ff9dd6",
                    300: "#ff71c3",
                    400: "#ff46b1",
                    500: "#ff1a9f",
                    600: "#d91687",
                    700: "#b3126f",
                    800: "#8c0e57",
                    900: "#660a40",
                    950: "#400728"
                },
                slate: {
                    50: "#f8fafc",
                    100: "#f1f5f9",
                    200: "#e2e8f0",
                    300: "#cbd5e1",
                    400: "#94a3b8",
                    500: "#64748b",
                    600: "#475569",
                    700: "#334155",
                    800: "#1e293b",
                    900: "#0f172a",
                    950: "#020617"
                },
                gray: {
                    50: "#f9fafb",
                    100: "#f3f4f6",
                    200: "#e5e7eb",
                    300: "#d1d5db",
                    400: "#9ca3af",
                    500: "#6b7280",
                    600: "#4b5563",
                    700: "#374151",
                    800: "#1f2937",
                    900: "#111827",
                    950: "#030712"
                },
                zinc: {
                    50: "#fafafa",
                    100: "#f4f4f5",
                    200: "#e4e4e7",
                    300: "#d4d4d8",
                    400: "#a1a1aa",
                    500: "#71717a",
                    600: "#52525b",
                    700: "#3f3f46",
                    800: "#27272a",
                    900: "#18181b",
                    950: "#09090b"
                },
                neutral: {
                    50: "#fafafa",
                    100: "#f5f5f5",
                    200: "#e5e5e5",
                    300: "#d4d4d4",
                    400: "#a3a3a3",
                    500: "#737373",
                    600: "#525252",
                    700: "#404040",
                    800: "#262626",
                    900: "#171717",
                    950: "#0a0a0a"
                },
                stone: {
                    50: "#fafaf9",
                    100: "#f5f5f4",
                    200: "#e7e5e4",
                    300: "#d6d3d1",
                    400: "#a8a29e",
                    500: "#78716c",
                    600: "#57534e",
                    700: "#44403c",
                    800: "#292524",
                    900: "#1c1917",
                    950: "#0c0a09"
                }
            },
            semantic: {
                primary: {
                50: '{surface.50}',
                100: '{surface.100}',
                200: '{surface.200}',
                300: '{surface.300}',
                400: '{surface.400}',
                500: '{surface.500}',
                600: '{surface.600}',
                700: '{surface.700}',
                800: '{surface.800}',
                900: '{surface.900}',
                950: '{surface.950}'
                },
                colorScheme: {
                    light: {
                        primary: {
                        color: '{primary.950}',
                        contrastColor: '#ffffff',
                        hoverColor: '{primary.900}',
                        activeColor: '{primary.800}'
                        },
                        highlight: {
                        background: '{primary.950}',
                        focusBackground: '{primary.700}',
                        color: '#ffffff',
                        focusColor: '#ffffff'
                        },
                    },
                    dark: {
                        primary: {
                        color: '{primary.50}',
                        contrastColor: '{primary.950}',
                        hoverColor: '{primary.100}',
                        activeColor: '{primary.200}'
                        },
                        highlight: {
                        background: '{primary.50}',
                        focusBackground: '{primary.300}',
                        color: '{primary.950}',
                        focusColor: '{primary.950}'
                        }
                    }
                }
            }
        });

        export default Noir;
        // export default MyPreset;
