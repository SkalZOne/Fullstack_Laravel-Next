export default function Label({ children, className = "", ...props }) {
  return (
    <label className={`${className} block text-indigo-700`} {...props}>
      {children}
    </label>
  );
}
