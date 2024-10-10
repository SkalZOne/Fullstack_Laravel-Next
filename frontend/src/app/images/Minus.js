const Minus = ({ className = "", fill = "#fff" }) => {
  return (
    <svg
      className={`${className} max-w-4 max-h-4`}
      width="800px"
      height="800px"
      viewBox="0 0 20 20"
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
    >
      <path
        fill={fill}
        fillRule="evenodd"
        d="M18 10a1 1 0 01-1 1H3a1 1 0 110-2h14a1 1 0 011 1z"
      />
    </svg>
  );
};

export default Minus;
