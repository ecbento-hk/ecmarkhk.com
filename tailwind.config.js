const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    purge: {
        content: [
            "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
            "./vendor/laravel/jetstream/**/*.blade.php",
            "./storage/framework/views/*.php",
            "./resources/views/**/*.blade.php",
        ],
    },

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: (theme) => ({
                "food-pattern": "url('/img/food-pattern.jpg')",
                "default-parttern": "url('')",
            }),
            backgroundSize: {
                auto: "auto",
                cover: "cover",
                contain: "contain",
                three: "300px",
                four: "400px",
            },
        },
    },

    variants: {
        extend: {
            opacity: ["disabled"],
        },
    },
    daisyui: {
        themes: [
            {
              'mytheme': {                          /* your theme name */
                 'primary' : '#F04E2A',           /* Primary color */
                 'primary-focus' : '#F04E2A',     /* Primary color - focused */
                 'primary-content' : '#ffffff',   /* Foreground content color to use on primary color */
      
                 'secondary' : '#179046',         /* Secondary color */
                 'secondary-focus' : '#179046',   /* Secondary color - focused */
                 'secondary-content' : '#ffffff', /* Foreground content color to use on secondary color */
      
                 'accent' : '#37cdbe',            /* Accent color */
                 'accent-focus' : '#2aa79b',      /* Accent color - focused */
                 'accent-content' : '#ffffff',    /* Foreground content color to use on accent color */
      
                 'neutral' : '#3d4451',           /* Neutral color */
                 'neutral-focus' : '#2a2e37',     /* Neutral color - focused */
                 'neutral-content' : '#ffffff',   /* Foreground content color to use on neutral color */
      
                 'base-100' : '#ffffff',          /* Base color of page, used for blank backgrounds */
                 'base-200' : '#f9fafb',          /* Base color, a little darker */
                 'base-300' : '#d1d5db',          /* Base color, even more darker */
                 'base-content' : '#1f2937',      /* Foreground content color to use on base color */
      
                 'info' : '#2094f3',              /* Info */
                 'success' : '#009485',           /* Success */
                 'warning' : '#ff9900',           /* Warning */
                 'error' : '#ff5724',             /* Error */
              },
            },
          ],
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("daisyui"),
    ],
};
