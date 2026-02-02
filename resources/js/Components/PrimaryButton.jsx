import { cva } from "class-variance-authority";
import { cn } from "@/lib/utils";

const buttonVariants = cva(
    "inline-flex items-center px-4 py-2 border rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25 disabled:cursor-not-allowed",
    {
        variants: {
            variant: {
                primary: "bg-gray-800 dark:bg-gray-200 border-transparent text-white dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:ring-indigo-500 dark:focus:ring-offset-gray-800",
                secondary: "bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-500 text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 disabled:opacity-25",
                danger: "bg-red-600 border-transparent text-white hover:bg-red-500 active:bg-red-700 focus:ring-red-500 dark:focus:ring-offset-gray-800",
            },
            size: {
                default: "px-4 py-2",
                sm: "px-3 py-1.5",
                lg: "px-8 py-3",
            },
        },
        defaultVariants: {
            variant: "primary",
            size: "default",
        },
    }
);

export default function PrimaryButton({ className = '', disabled, variant = "primary", size = "default", children, ...props }) {
    return (
        <button
            {...props}
            className={cn(buttonVariants({ variant, size, className }))}
            disabled={disabled}
        >
            {children}
        </button>
    );
}
