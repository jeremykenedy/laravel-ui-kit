const colors = { primary: 'text-blue-600 dark:text-blue-400', success: 'text-green-600 dark:text-green-400', warning: 'text-amber-600 dark:text-amber-400', danger: 'text-red-600 dark:text-red-400', default: 'text-gray-900 dark:text-gray-100' };
export default function UiStatCard({ value, label, variant = 'default', href }) {
  const Tag = href ? 'a' : 'div';
  return (<Tag href={href} className={`block rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 ${href ? 'hover:border-gray-300 transition-colors' : ''}`}>
    <p className={`text-3xl font-bold ${colors[variant] || colors.default}`}>{value}</p>
    <p className="text-sm text-gray-500 dark:text-gray-400 mt-1">{label}</p>
  </Tag>);
}
