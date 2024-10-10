const Arrow = ({ className = "", fill = "#fff" }) => {
  return (
    <svg
      className={`${className} max-w-4 max-h-4`}
      fill={fill}
      width="800px"
      height="800px"
      viewBox="0 0 24 24"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z" />
    </svg>
  );
};

export default Arrow;
