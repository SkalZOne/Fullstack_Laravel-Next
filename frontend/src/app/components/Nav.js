import Link from "next/link";

const Nav = ({ children }) => {
  return (
    <nav className="p-4">
      <ul className="flex justify-around">
        <Link className="uppercase font-semibold border-b-2 border-b-black hover:text-gray-700 hover:border-gray-700 transition-colors" href="/">
          Home
        </Link>
        <Link className="uppercase font-semibold border-b-2 border-b-black hover:text-gray-700 hover:border-gray-700 transition-colors" href="/about">
          About
        </Link>
        <Link className="uppercase font-semibold border-b-2 border-b-black hover:text-gray-700 hover:border-gray-700 transition-colors" href="/">
          Services
        </Link>
      </ul>
    </nav>
  );
};

export default Nav;
